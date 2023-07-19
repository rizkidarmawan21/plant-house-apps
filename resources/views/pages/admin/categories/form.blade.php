@extends('layouts.dashboard')

@section('title')
    Store Dashboard Category Create
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Add New Category</h2>
                <p class="dashboard-subtitle">Create your category product</p>
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

                    <div class="col-md-6">
                        <form
                            action="{{ isset($category) ? route('admin.category.update', $category->id) : route('admin.category.store') }}"
                            method="POST">
                            @csrf

                            @if (isset($category))
                                @method('put')
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Category Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="name" name="name"
                                                    value="{{ isset($category) ? $category->name : '' }}" />
                                                @error('name')
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
