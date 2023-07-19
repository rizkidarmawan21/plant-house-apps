<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Transaction;
use App\Models\Category;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $search  =  $request->search;



        // get most popular to buy
        $most_popular = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->select('product_id', DB::raw('COUNT(product_id) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'DESC')
            ->take(4)
            ->get();


        $categories = Category::all();

        $products = Product::with(['galleries', 'category']);

        $products->when(request('search', false), function ($query) use ($search) {
            // $query->where('name', 'like', '%' . $search . '%');
            // make where like name, and category name
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        });

        $products = $products->paginate(12);
        

        return view('pages.shop', compact('products', 'most_popular', 'categories'));
    }
}
