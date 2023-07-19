@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
            </div>


            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    @forelse ($products as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a class="card card-dashboard-product d-block"
                                href="{{ route('admin.product.show', $item->id) }}">
                                <div class="card-body">
                                    <img src="{{ isset($item->galleries[0]) ? asset($item->galleries[0]->image) : 'https://clicxy.com/wp-content/uploads/2016/04/dummy-post-horisontal.jpg' }}"
                                        alt="" style="height: 200px; object-fit: cover"
                                        class="img-fluid rounded-4 w-100 mb-2" />
                                    <div class="product-title">{{ $item->name }}</div>
                                    <div class="product-category">{{ $item->category->name }}</div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Anda Belum memiliki produk yang akan dijual</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
