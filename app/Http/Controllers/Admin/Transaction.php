<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction as ModelsTransaction;
use Illuminate\Http\Request;

class Transaction extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = ModelsTransaction::with(['transactionDetails', 'transactionShipping'])->get();

        return view('pages.admin.transactions.index', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsTransaction $transaction)
    {
        $transaction->with(['transactionDetails', 'transactionShipping'])->get();
        return view('pages.admin.transactions.detail', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsTransaction $transaction)
    {
        try {
            $request->validate([
                'shipping_status' => 'required|in:pending,shipping,success',
                'resi' => 'required_if:shipping_status,shipping'
            ]);

            $transaction->update([
                'shipping_status' => $request->shipping_status,
                'resi_number' => $request->resi ?? null
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction status updated to ' . $request->shipping_status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
