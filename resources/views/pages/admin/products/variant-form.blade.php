@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Variant Create
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Add New Variant Product</h2>
                <p class="dashboard-subtitle">Create your own variant product</p>
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
                            action="{{ isset($variant) ? route('admin.product.variant.update', $variant->id) : route('admin.product.variant.store', $product->id) }}"
                            method="POST">
                            @csrf
                            @if (isset($variant))
                                @method('PUT')
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <h5>Product : {{ isset($variant) ? $variant->product->name : $product->name }}
                                    </h5>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="name" name="name" value="{{ isset($variant) ? $variant->name : "" }}" />
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
                                                    aria-describedby="price" name="price" value="{{ isset($variant) ? $variant->price : "" }}" />
                                                @error('price')
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
                                                    aria-describedby="stock" name="stock" value="{{ isset($variant) ? $variant->stock : "" }}" />
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
                                            value="{{ isset($variant) ? $variant->weight : "" }}" />
                                                @error('weight')
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
                                    <a href="{{ route('admin.product.show', isset($variant) ? $variant->product->id : $product->id) }}"
                                        class="btn btn-secondary btn-block px-5">
                                        Back
                                    </a>
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
