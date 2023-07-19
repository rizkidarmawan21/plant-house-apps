@extends('layouts.app')

@section('title')
    Store Shop Page
@endsection
@section('content')
    <br>
    <br>
    <br>
    <div class="page-shop">
        <div class="container my-5">
            <section class="hero rounded-5 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{ asset('images/gmbr sayur.png') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes"
                            width="700" height="500" loading="lazy" />
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3">
                            Cari artikel tentang hidroponik
                        </h1>
                        <p class="lead">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Quisquam
                            voluptatum, quibusdam, voluptate, quia
                        </p>
                    </div>
                </div>
            </section>

            <section class="fillters">
                <div class="container">
                    <div class="d-flex justify-content-end py-5 py-5">
                        <div class="col-lg-4 col-md-12 col-12 my-2">
                            <form action="#products" method="get">
                                <div class="input-group">
                                    <input class="form-control border-end-0 border rounded-pill " type="search"
                                        name="search" id="example-search-input" />
                                    <span class="input-group-append">
                                        <button type="submit" class="btn border-0 border ms-n5 w-25" type="button">
                                            <i class="fa-solid fa-magnifying-glass" style="color: #185350"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <section id="products" class="rounded-4 p-sm-1 p-md-3 p-lg-4">
                <div class="container">
                    <div class="row">
                        <div class="title-best-seller mt-3" data-aos="fade-up" data-aos-delay="100">
                            <h5>Artikel Kami</h5>
                        </div>
                    </div>
                    <div class="row justify-content-evenly mt-4">

                        @forelse ($articles as $item)
                            <div class="col-12 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ route('article.show', $item->slug) }}" class="component-product d-block px-4">
                                    <div class="product-tumbnail">
                                        <div class="product-image"
                                            style="
                                                background-image: url('{{ asset($item->image) }}');
                                            ">
                                        </div>
                                    </div>
                                    <div style="font-size: 12px" class="mt-3 text-secondary">
                                        {{ Carbon\Carbon::parse($item->created_at)->format('F d, Y') }} -
                                        {{ $item->author }}
                                    </div>
                                    <div class="product-text fw-bold">{{ $item->title }}</div>
                                    <div class="text-secondary mt-3 line-clamp" align="justify">
                                        {!! $item->description !!}
                                    </div>
                                    <div class="product-price d-flex justify-content-between align-items-center my-3">
                                        View Detail
                                        <i class="circle fa-solid fa-arrow-right-long fa-xs text-white"></i>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    Artikel tidak ditemukan
                                </div>
                            </div>
                        @endforelse
                    </div>


                    @if (isset($_GET['search']))
                        @if ($_GET['search'] == null)
                            {{ $articles->links('vendor.pagination.bootstrap-5') }}
                        @endif
                    @else
                        {{ $articles->links('vendor.pagination.bootstrap-5') }}
                    @endif


                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-style')
    <style>
        .line-clamp {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
@endpush
