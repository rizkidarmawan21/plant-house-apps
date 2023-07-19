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
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="name" name="name" />
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
                                                    aria-describedby="price" name="price" />
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
                                                    aria-describedby="name" name="slug" />
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
                                                    aria-describedby="stock" name="stock" />
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
                                                    aria-describedby="weight" name="weight" />
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
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                <textarea id="editor" name="description"></textarea>
                                                @error('description')
                                                    <div class="text-danger">
                                                        <small>{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="thumbnails">Thumbnail</label>
                                                <input type="file" multiple class="form-control pt-1" id="thumbnails"
                                                    aria-describedby="thumbnails" name="thumbnails[]" />
                                                <small class="text-muted">
                                                    Pilih gambar utama dari produk yang kamu jual.
                                                </small>
                                                @error('thumbnails')
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

        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/admin/product/cekSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endpush
