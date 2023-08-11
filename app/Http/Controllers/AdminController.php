<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // total product
        $total_product = Product::count();
        // total transaction
        $total_transaction = Transaction::where('payment_status', 'PAID')->count();

        // total revenue
        $transaction = Transaction::with(['transactionShipping'])->get();

        $revenue = 0;
        foreach ($transaction as $item) {
            // total price - shipping price
            $revenue += $item->total_price - $item->transactionShipping->shipping_price;
        }


        dd($revenue);

        // return view('pages.admin.admin');
    }
}
