@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Create
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Add New Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
            </div>
            <div class="dashboard-content mt-5">
                <div class="row">

                    {{-- make flask message with session --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success col-md-12">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger col-md-12">
                            {{ session()->get('error') }}
                        </div>
                    @endif



                    <div class="col-12">
                        <form
                            action="{{ isset($article) ? route('admin.article.update', $article->id) : route('admin.article.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($article))
                                @method('put')
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title"
                                                    aria-describedby="title" name="title"
                                                    value="{{ isset($article) ? $article->title : '' }}" />
                                                @error('title')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Slug Name</label>
                                                <input type="text" class="form-control" id="slug"
                                                    aria-describedby="name" name="slug"
                                                    value="{{ isset($article) ? $article->slug : '' }}" />
                                                @error('slug')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="author">Author</label>
                                                <input type="text" class="form-control" id="author"
                                                    aria-describedby="author" name="author"
                                                    value="{{ isset($article) ? $article->author : '' }}" />
                                                @error('author')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_on_landing">Show in Landing Page</label>
                                                <select name="is_on_landing" id="is_on_landing" class="form-control">
                                                    <option value="0"
                                                        {{ isset($article) ? ($article->is_on_landing == 0 ?: 'selected') : '' }}>
                                                        No</option>
                                                    <option value="1"
                                                        {{ isset($article) ? ($article->is_on_landing == 1 ?: 'selected') : '' }}>
                                                        Yes</option>
                                                </select>
                                                @error('is_on_landing')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="editor" name="description">
                                                    {{ isset($article) ? $article->description : '' }}
                                                </textarea>
                                                @error('description')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="image">Thumbnail</label>
                                                @if (isset($article))
                                                    <br>
                                                    <img src="{{ asset($article->image) }}" alt=""
                                                        class="img-thumbnail img-fluid my-4" width="400">
                                                @endif
                                                <input type="file" multiple class="form-control pt-1" id="image"
                                                    aria-describedby="image" name="image" />
                                                <small class="text-muted">
                                                    Pilih gambar utama dari produk yang kamu jual.
                                                </small>
                                                @error('image')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-block px-5">
                                        Save Now
                                    </button>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace("editor");

        const name = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/admin/article/cekSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endpush
