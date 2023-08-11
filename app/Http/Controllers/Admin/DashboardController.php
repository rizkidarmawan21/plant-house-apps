<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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

        $recent_transaction = Transaction::orderBy('id', 'desc')->take(5)->get();

        return view('pages.admin.admin',compact('total_product','total_transaction','revenue','recent_transaction'));
    }
}
