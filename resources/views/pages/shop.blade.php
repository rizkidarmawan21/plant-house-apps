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
                        <img src="images/gmbr sayur.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes"
                            width="700" height="500" loading="lazy" />
                    </div>
                    <div class="col-lg-6">
                        <h5 class="lh-1 mb-3">
                            Selamat Datang di Argha Hidroponik
                        </h5>
                        <h1 class="display-5 fw-bold lh-1 mb-3">
                            Pilih Sayuran Favorit Anda
                        </h1>
                        <p class="lead">
                            Rasakan hidup sehat dengan makan sayuran. itu
                            akan meningkatkan ruang hidup Anda!
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="button" class="btn btn-hero btn-md px-4 me-md-2">
                                Klik ke Troli
                            </button>
                            <button type="button" class="btn btn-hero btn-md px-4 me-md-2">
                                Tentang Kami
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="fillters">
                <div class="container">
                    <div class="row align-items-center py-5 py-5">
                        <div class="col-lg-5 col-md-12 col-sm-12 d-flex justify-content-left gap-5 my-3">
                            @foreach ($categories as $item)
                                <div onclick="window.location.href='?search={{ $item->name }}#products'" type="button"
                                    class="rhombus">
                                    <p class="rhombus-text">{{ $item->name }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-7 col-md-12 col-sm-12 my-2">
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

            <section class="store-best-seller rounded-4 p-sm-1 p-md-3 p-lg-4">
                <div class="container">
                    <div class="row">
                        <div class="title-best-seller mt-3" data-aos="fade-up" data-aos-delay="100">
                            <h5>Terlaris</h5>
                        </div>
                    </div>
                    <div class="row justify-content-evenly">
                        @foreach ($most_popular as $item)
                            <div class="col-5 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                                <a href="{{ route('detail', $item->product->slug) }}" class="component-product d-block">
                                    <div class="product-tumbnail">
                                        <div class="product-image"
                                            style="
                                                background-image: url('{{ $item->product->galleries->first()->image }}');
                                            ">
                                        </div>
                                    </div>
                                    <div class="product-text">{{ $item->product->name }}</div>
                                    <div class="product-price d-flex justify-content-between align-items-center">

                                        @if ($item->product->variants->isEmpty())
                                            Rp. {{ number_format($item->product->price) }}
                                        @else
                                            Rp. {{ number_format($item->product->variants[0]->price) }}
                                            @if (count($item->product->variants) != 1)
                                                ...
                                                Rp.{{ number_format($item->product->variants[count($item->product->variants) - 1]->price) }}
                                            @endif
                                        @endif
                                        <i class="circle fa-solid fa-arrow-right-long fa-xs text-white"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="products" class="rounded-4 p-sm-1 p-md-3 p-lg-4">
                <div class="container">
                    <div class="row">
                        <div class="title-best-seller mt-3" data-aos="fade-up" data-aos-delay="100">
                            <h5>Produk Kami</h5>
                        </div>
                    </div>
                    <div class="row justify-content-evenly mt-4">
                        @forelse ($products as $product)
                            <div class="col-5 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                                <a href="{{ route('detail', $product->slug) }}" class="component-product d-block">
                                    <div class="product-tumbnail">

                                        <div class="product-image"
                                            style="
                                                background-image: url('{{ $product->galleries->first()->image }}');
                                            ">
                                        </div>
                                    </div>
                                    <div class="product-text">{{ $product->name }}</div>
                                    <div class="product-text" style="font-size: 14px; color:#33927a">
                                        {{ $product->category->name }}</div>
                                    <div class="product-price d-flex justify-content-between align-items-center">
                                        @if ($product->variants->isEmpty())
                                            Rp. {{ number_format($product->price) }}
                                        @else
                                            Rp. {{ number_format($product->variants[0]->price) }}
                                            @if (count($product->variants) != 1)
                                                ...
                                                Rp.{{ number_format($product->variants[count($product->variants) - 1]->price) }}
                                            @endif
                                        @endif
                                        <i class="circle fa-solid fa-arrow-right-long fa-xs text-white"></i>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="col-12 text-center py-5 bg-light fs-5" data-aos="fade-up" data-aos-delay="100">
                                Aduh produk yang kamu cari tidak ada nih
                            </div>
                        @endforelse

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="?perPage={{ $perPage + 20}}" class="btn btn-see-all text-white rounded-3 @if($perPage === $maxPerPage) disabled @endif" type="button">
                                Tampilkan Lebih Banyak >
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about -->

            <!-- monitoring -->
            <section class="">
                <div class="container">
                    <h6 class="text-center mb-0 mt-5">
                        Ingin Membeli Argha Hidroponik di Official Store
                        Kami? <br />
                        Kunjungi Nama Toko Kami di Bawah Ini !
                    </h6>
                    <div class="row mt-5 pemasaran">
                        <h5 class="text-center mt-4">Pemasaran</h5>
                        <div class="col-6 col-md-3 mt-3 text-center">
                            <p>Tokopedia :</p>
                            <p>Argha Hidroponik</p>
                        </div>
                        <div class="col-6 col-md-3 mt-3 text-center">
                            <p>Shopee :</p>
                            <p>Argha Hidroponik</p>
                        </div>
                        <div class="col-6 col-md-3 mt-3 text-center">
                            <p>Bukalapak :</p>
                            <p>Argha Hidroponik</p>
                        </div>
                        <div class="col-6 col-md-3 mt-3 text-center">
                            <p>lazada :</p>
                            <p>Argha Hidroponik</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
