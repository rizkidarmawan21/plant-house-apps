<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function create(Product $product)
    {
        return view('pages.admin.products.variant-form', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // check if id product is exist
        if (!$product->id) {
            return redirect()->back();
        }

        $validation = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $validation['product_id'] = $product->id;

        ProductVariant::create($validation);

        return redirect()->route('admin.product.show', $product->id)->with('success', 'Product variant successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $variant)
    {

        $variant = ProductVariant::with('product')->findOrFail($variant->id);
        return view('pages.admin.products.variant-form', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $variant)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $variant->update($validation);

        return redirect()->route('admin.product.show', $variant->product_id)->with('success', 'Product variant successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $variant)
    {
        $variant->delete();

        return redirect()->route('admin.product.show', $variant->product_id)->with('success', 'Product variant successfully deleted');
    }
}
