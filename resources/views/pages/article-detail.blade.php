@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection
@section('content')
    <div class="page-content page-details">
        <section class="store-breadcumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Article Details
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- store-gallery -->

        <section class="store-gallery" id="gallery">
            <div class="container">
                <h1>{{ $article->title }}</h1>
                <h6 class="mb-4 text-secondary"> {{ Carbon\Carbon::parse($article->created_at)->format('F d, Y') }} -
                    Created by {{ $article->author }}</h6>
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div class="col-12 col-md-8 col-lg-8 mx-auto">
                            <img src="{{ asset($article->image) }}" style="width:100%; max-height: 500px; object-fit: cover" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- store-details-container -->
        <div class="store-details-container" data-aos="fade-up">
            <section class="store-description mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-4 mb-5">
                            {!! $article->description !!}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-style')
    <style>
        .btn-close-modal {
            position: absolute;
            top: -10px !important;
            right: -10px !important;
            width: 35px;
            height: 35px;
            cursor: pointer;
        }

        .qty {
            padding: 0 1rem;
        }

        .btn-plus,
        .btn-minus {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid #e5e5e5;
        }
    </style>
@endpush
