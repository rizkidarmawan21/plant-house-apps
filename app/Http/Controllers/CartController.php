<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Provincy;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provinces = Provincy::with('cities')->get();
        $carts = Cart::with(['variant', 'product.galleries'])->where('user_id', auth()->user()->id)->get();
        return view('pages.cart', compact('carts', 'provinces'));
    }

    public function success()
    {
        return view('pages.success');
    }

    public function store(Product $product, Request $request)
    {
        $variant_id = $request->variant_id;

        $rules = [
                'quantity' => 'required|integer'
            ];

        if ($product->variants->isNotEmpty()) {

            $rules = [
                'variant_id' => 'required'
            ];
        }

        $request->validate($rules);
        
        // check if variant id send from request
        if ($product->variants->isNotEmpty()) {
            // if product variant ready check stock is ready or not
            $productVariant = ProductVariant::findOrFail($variant_id);
            if ($productVariant->stock == 0) {
                return redirect()->back()->with('error', 'Maaf, produk ini sudah habis');
            }

            if ($productVariant->stock < $request->quantity) {
                return redirect()->back()->with('error', 'Maaf, stok produk ini tidak mencukupi');
            }
        } else {
            if ($product->stock == 0) {
                return redirect()->back()->with('error', 'Maaf, produk ini sudah habis');
            }

            if ($product->stock < $request->quantity) {
                return redirect()->back()->with('error', 'Maaf, stok produk ini tidak mencukupi');
            }
        }


       

        try {
            // check if product is already in cart

            // if true, update quantity
            $cart = Cart::where('product_id', $product->id)->where('user_id', auth()->user()->id);

            $cart->when(request('variant_id', 'false'), function ($q) use ($variant_id) {
                $q->where('product_variant_id', $variant_id);
            });

            $cart = $cart->first();

            if ($cart) {
                $cart->update([
                    'quantity' => $cart->quantity + $request->quantity
                ]);

                return redirect()->back()->with('success', 'Produk kamu sudah masuk ke keranjang');
            }

            $data = [
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
                'quantity' => $request->quantity,
                'product_variant_id' => $variant_id ?? null
            ];

            Cart::create($data);

            return redirect()->back()->with('success', 'Produk kamu sudah masuk ke keranjang');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateQuantity(Cart $cart, Request $request)
    {
        $request->validate([
            'type' => 'required|in:increment,decrement'
        ]);
        $status = $request->type;

        if ($status == 'increment') {
            $cart->update([
                'quantity' => $cart->quantity + 1
            ]);

            // return response json
            return response()->json([
                'message' => 'Berhasil menambahkan jumlah produk'
            ]);
        } else if ($status == 'decrement') {

            if ($cart->quantity == 1) {
                // return response json
                return response()->json([
                    'message' => 'Sudah mencapai jumlah minimum'
                ]);
            }

            $cart->update([
                'quantity' => $cart->quantity - 1
            ]);

            // return response json
            return response()->json([
                'message' => 'Berhasil mengurangi jumlah produk'
            ]);
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
