<?php

namespace App\Http\Controllers;

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
        $perPage = $request->query('perPage', 20);
        $page = $request->query('page', 1);

        $maxPerPage = Product::count();

        if($perPage > $maxPerPage){
            $perPage = $maxPerPage;
        }

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
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        });

        $products = $products->paginate($perPage, ['*'], 'page', $page);
        

        return view('pages.shop', compact('products', 'most_popular', 'categories','perPage','maxPerPage'));
    }
}
