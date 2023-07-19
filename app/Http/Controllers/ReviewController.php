<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index($id)
    {
        $transaction = Transaction::with(['transactionDetails', 'transactionShipping'])->findOrFail($id);

        if ($transaction->shipping_status == 'success' and $transaction->user_id != auth()->user()->id) {
            return redirect()->back();
        }

        return view('pages.review', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'review.*.message' => 'required',
        ]);

        $review = $request->review;

        try {
            DB::beginTransaction();
            foreach ($review as $key => $item) {
                Review::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $key,
                    'messages' => $item['message'],
                ]);
            }
            DB::commit();

            return redirect(route('user.transaction.index'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('user.transaction.index')->with('error', $e->getMessage());
        }
    }
}
