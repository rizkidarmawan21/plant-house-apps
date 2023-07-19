<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class MyTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['transactionDetails', 'transactionShipping'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.transaction', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['transactionDetails', 'transactionShipping'])->findOrFail($id);

        return view('pages.detail-transaction', compact('transaction'));
    }

    public function terimaPesanan($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'shipping_status' => 'success'
        ]);

        return redirect()->route('user.review.index', $id);   
    }
}
