<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // with galleries where is_thumbail true
        $products = Product::with('galleries')->get();
        

        return view('pages.admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.products.form', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $request)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' =>  $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->weight,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
            ];
            $product = Product::create($data);


            if ($request->hasFile('thumbnails')) {

                foreach ($request->file('thumbnails') as $thumbnail) {
                    $image_path = 'storage/' . $thumbnail->store('product/image', 'public');

                    ProductGallery::create([
                        'product_id' => $product->id,
                        'image' =>  $image_path,
                    ]);
                }
            } else {
                return back()->with('error', 'Ada kesalahan saat mengupload gambar');
            }


            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['galleries', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.admin.products.detail', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        try {
            DB::beginTransaction();

            $data = [
                'name' =>  $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'category_id' => $request->category_id,
            ];
            $product->update($data);

            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->with('error', $e->getMessage());
        }
    }

    public function addImage($id, Request $request)
    {
        $product = Product::findOrFail($id);


        if ($request->hasFile('thumbnails')) {

            DB::beginTransaction();
            foreach ($request->file('thumbnails') as $thumbnail) {
                $image_path = 'storage/' . $thumbnail->store('product/image', 'public');

                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' =>  $image_path,
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Gambar berhasil ditambahkan');
        } else {
            DB::rollBack();
            return back()->with('error', 'Ada kesalahan saat mengupload gambar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyImage($image)
    {
        $id = $image;
        $product_gallery = ProductGallery::findOrFail($id);

        if (file_exists($product_gallery->image)) {
            Storage::delete(substr($product_gallery->image, 8));
        }


        $product_gallery->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus');
    }

    // untuk cek slug agar terisi otomatis
    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
