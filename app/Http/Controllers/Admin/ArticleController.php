<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('pages.admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.articles.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $data = $request->all();
        $image_path = 'storage/' . $request->image->store('article/image', 'public');
        $data['image'] = $image_path;

        Article::create($data);

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('pages.admin.articles.form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->all();       
            if ($request->image) {
                if (file_exists($article->image)) {
                    Storage::delete('public/' . substr($article->image, 8));
                }
                $image_path = 'storage/' . $request->image->store('article/image', 'public');
                $data['image'] = $image_path;
            }

        $article->update($data);

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // dd(substr($article->image, 8));
        if (file_exists($article->image)) {
            echo "ada";
            Storage::delete('public/' . substr($article->image, 8));
        }
        $article->delete();

        return redirect()->route('admin.article.index')->with('success', 'Artikel berhasil dihapus');
    }

    // untuk cek slug agar terisi otomatis
    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
