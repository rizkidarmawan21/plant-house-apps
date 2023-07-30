<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionShipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    public function checkout(CheckoutRequest $request)
    {

        // get data product from cart
        $products = Cart::with(['product'])->where('user_id', auth()->id())->get();

        // check stock
        foreach ($products as $product) {
            if ($product->variant) {
                $productVariant = ProductVariant::findOrFail($product->product_variant_id);
                if ($productVariant->stock < $product->quantity) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Maaf, stok pada produk ". $product->product->name ." ". $productVariant->name ." tidak mencukupi",
                    ], 500);
                }
            } else {
                if($product->product->stock < $product->quantity) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Maaf, stok pada produk ". $product->product->name ." tidak mencukupi",
                    ], 500);
                }
            }
        }
        try {

            DB::beginTransaction();



            // get total price
            $total_price = 0;
            foreach ($products as $product) {
                $total_price += ($product->variant ? $product->variant->price  :  $product->product->price) * $product->quantity;
            }

            // Generate Invoice Code
            $length = 10;
            $random = "";
            $characters = array_merge(range('A', 'Z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $random .= $characters[$rand];
            }
            $invoice_code = "ORDER-$random";

            // create transaction
            $transaction_data = [
                'user_id' => auth()->id(),
                'address' => $request->address,
                'detail_address' => $request->detail_address,
                'phone_number' => $request->phone_number,
                'invoice_code' => $invoice_code,
                'total_price' => $total_price + $request->shipping_price,
            ];
            $transaction = Transaction::create($transaction_data);


            $city = City::where('id', $request->city_id)->first();
            // create transaction shipping
            $transaction_shipping_data = [
                'transaction_id' => $transaction->id,
                'provincy_id' => $city->province_id,
                'city_id' => $city->city_id,
                'origin_city' => 'Semarang',
                'postal_code' => $city->postal_code,
                'courier' => $request->courier,
                'service' => $request->service,
                'service_description' => "$request->service_description ($request->etd)",
                'shipping_price' => $request->shipping_price,
            ];

            TransactionShipping::create($transaction_shipping_data);

            // create transaction detail
            foreach ($products as $product) {
                $transaction_detail_data = [
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->product->id,
                    'price' => $product->variant ? $product->variant->price : $product->product->price,
                    'qty' => $product->quantity,
                    'product_variant_id' => $product->product_variant_id
                ];
                TransactionDetail::create($transaction_detail_data);


                if ($product->variant) {
                    // update stock product variant
                    $product->variant->update([
                        'stock' => $product->variant->stock - $product->quantity,
                    ]);
                } else {
                    // update stock product
                    Product::where('id', $product->product->id)->update([
                        'stock' => $product->product->stock - $product->quantity,
                    ]);
                }
            }


            // midtrans payment
            $transaction_details = [
                'order_id' => $transaction->invoice_code,
                'gross_amount' => $transaction->total_price,
            ];

            $item_details = [];
            foreach ($products as $product) {
                $item_details[] = [
                    'id' => $product->variant ? $product->product->id . "-v" . $product->variant->id : $product->product->id,
                    'price' => $product->variant ? $product->variant->price : $product->product->price,
                    'quantity' => $product->quantity,
                    'name' => $product->variant ? $product->product->name . "-" . $product->variant->name : $product->product->name,
                ];
            }

            $item_details[] = [
                'id' => 'ongkir',
                'price' => $request->shipping_price,
                'quantity' => 1,
                'name' => "Ongkos Kirim ($request->courier - $request->service_description)",
            ];

            $userData = [
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'address' => $transaction->address,
                'city' => $city->city_name,
                'postal_code' => $city->postal_code,
                'country_code' => 'IDN',
            ];
            $customer_details = [
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => $transaction->phone_number,
                'billing_address' => $userData,
                'shipping_address' => $userData,
            ];

            $midtans_params = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
            ];

            $midtransSnap = Snap::createTransaction($midtans_params);

            // delete cart
            Cart::where('user_id', auth()->id())->delete();

            $transaction->update([
                'midtrans_url' => $midtransSnap->redirect_url,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Checkout Success',
                'payment_url' => $midtransSnap->redirect_url,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function midtransCallback(Request $request)
    {

        // dd($request);
        $notif = $request->method() == 'POST' ? new Notification() : MidtransTransaction::status($request->order_id);
        // dd($notif);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $checkout = Transaction::with('transactionDetails')->where('invoice_code', $notif->order_id)->first();

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $checkout->payment_status = 'paid';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            }

            // back quantity product
            foreach ($checkout->transactionDetails as $transactionDetail) {
                Product::where('id', $transactionDetail->product_id)->update([
                    'stock' => $transactionDetail->product->stock + $transactionDetail->qty,
                ]);
            }

            // delete transaction
            $checkout->delete();
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $checkout->payment_status = 'failed';
            // back quantity product
            foreach ($checkout->transactionDetails as $transactionDetail) {
                Product::where('id', $transactionDetail->product_id)->update([
                    'stock' => $transactionDetail->product->stock + $transactionDetail->qty,
                ]);
            }

            // delete transaction
            $checkout->delete();
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $checkout->payment_status = 'paid';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $checkout->payment_status = 'pending';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $checkout->payment_status = 'failed';
            // back quantity product
            foreach ($checkout->transactionDetails as $transactionDetail) {
                Product::where('id', $transactionDetail->product_id)->update([
                    'stock' => $transactionDetail->product->stock + $transactionDetail->qty,
                ]);
            }

            // delete transaction
            $checkout->delete();
        }

        $checkout->save();

        return view('pages.success');
    }
}
