@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Detail
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $product->name }}</h2>
                <p class="dashboard-subtitle">Product Details</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="name" name="name" value="{{ $product->name }}" />
                                                @error('name')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" id="price"
                                                    aria-describedby="price" name="price" value="{{ $product->price }}" />
                                                @error('price')
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
                                                    aria-describedby="name" name="slug" value="{{ $product->slug }}" />
                                                @error('slug')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" class="form-control" id="stock"
                                                    aria-describedby="stock" name="stock" value="{{ $product->stock }}" />
                                                @error('stock')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight">Berat (Satuan Gram)</label>
                                                <input type="number" class="form-control" id="weight"
                                                    aria-describedby="weight" name="weight"
                                                    value="{{ $product->weight }}" />
                                                @error('weight')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select name="category_id" class="form-control">
                                                    <option value="">-- Pilih Category Product --</option>
                                                    @forelse ($categories as $item)
                                                        <option value="{{ $item->id }}" @selected($product->category_id === $item->id)>
                                                            {{ $item->name }}</option>
                                                    @empty
                                                        <option value="">Tidak ada category</option>
                                                    @endforelse
                                                </select>
                                                @error('category_id')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="editor" name="description">{{ $product->description }}</textarea>
                                                @error('description')
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
                                    <button type="submit" class="btn btn-secondary btn-block px-5">
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('pages.admin.products.variant')
                </div>
                <div class="row mt-4">
                    @foreach ($product->galleries as $gallery)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="gallery-container">
                                        <img src="{{ asset($gallery->image) }}" alt=""
                                            class="w-100 img-fluid rounded-3" style="height: 270px; object-fit: cover" />

                                        <form action="{{ route('admin.product.delete.image', $gallery->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-gallery">
                                                <img src="/images/icon-delete.svg" alt="" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-3 mb-5">

                    <div class="col-12">
                        <form action="{{ route('admin.product.upload.image', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="thumbnails[]" id="file" style="display: none;" multiple
                                onchange="form.submit()" />
                            <button type="button" class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                                Add Photo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
@endsection

@push('addon-style')
    <style>
        .delete-gallery {
            background: none;
            border: 0px
        }
    </style>
@endpush

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>

    <script>
        CKEDITOR.replace("editor");

        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/admin/product/cekSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endpush
