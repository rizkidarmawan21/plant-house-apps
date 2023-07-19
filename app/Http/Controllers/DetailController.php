<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug)
    {

        $product = Product::with(['galleries', 'category'])->where('slug', $slug)->firstOrFail();

        // if ($product->stock == 0) {
        //     return redirect()->back()->with('error', 'Maaf, produk ini sudah habis');
        // }

        return view('pages.detail', compact('product'));
    }
}
