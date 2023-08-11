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
                                Product Details
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- store-gallery -->

        <section class="store-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :key="photos[activePhoto].id" :src="photos[activePhoto].url" class="w-100 main-image"
                                alt="" style="max-height: 600px; object-fit: cover" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt=""
                                        style="max-height: 150px; object-fit: cover" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- store-details-container -->
        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>

                            @if ($product->variants->isNotEmpty())
                                <div class="owner mt-4">Variants :</div>
                                <div class="row my-3">
                                    @foreach ($product->variants as $variant)
                                        <div class="col-md-4 mb-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6>{{ $variant->name }}</h6>
                                                    <div class="owner">Stock Ready : {{ $variant->stock }}</div>
                                                    <div class="owner">Berat Produk : {{ $variant->weight }} Gram</div>
                                                    <div class="price">Rp. {{ number_format($variant->price) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="owner">Stock Ready : {{ $product->stock }}</div>
                                <div class="owner">Berat Produk : {{ $product->weight }} Gram</div>
                                <div class="price">Rp. {{ number_format($product->price) }}</div>
                            @endif
                        </div>
                        <div class="col-lg-2 text-center" data-aos="zoom-in">
                            @if ($product->variants->isNotEmpty())
                                <a class="btn btn-content px-4 text-white btn-block mb-3" data-bs-toggle="modal"
                                    data-bs-target="#addCartModal">Add to
                                    Cart
                                </a>
                            @else
                                @if ($product->stock > 0)
                                    <a class="btn btn-content px-4 text-white btn-block mb-3" data-bs-toggle="modal"
                                        data-bs-target="#addCartModal">Add to
                                        Cart
                                    </a>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </section>
            <section class="store-description mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <h5>Description</h5>
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review ({{ count($product->reviews) }})</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                @foreach ($product->reviews as $item)
                                    <li class="media mb-3">
                                        @if ($item->user->photo)
                                            <img src="{{ asset($item->user->photo) }}" class="me-3 rounded-circle"
                                                alt="" style="width: 40px; height:40px; background-size: cover" />
                                        @else
                                            <img src="{{ asset('images/icon-user.png') }}" class="me-3 rounded-circle"
                                                alt="" style="width: 40px; height:40px; background-size: cover" />
                                        @endif

                                        <div class="media-body">
                                            <h5 class="mt-2 mb-1">{{ $item->user->name }}</h5>
                                            {{ $item->messages }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCartModal" tabindex="-1" aria-labelledby="addCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('cart.store', $product->id) }}" method="post">
                    @csrf
                    <div class="btn-close-modal" @click="closeModal()">
                        <img src="{{ asset('images/icon-delete.svg') }}" width="35px" height="35px">
                    </div>
                    <div class="modal-body ">
                        <div class="d-flex">
                            <img src="{{ asset($product->galleries[0]->image) }}" class="rounded-3"
                                style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                            <div class="ms-3 align-self-end">
                                <h6>{{ $product->name }}</h6>
                                @if ($product->variants->isEmpty())
                                    <p>Stock: {{ $product->stock }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($product->variants->isNotEmpty())
                        <hr style="margin-top: -10px !important">
                        <div class="modal-body">
                            <p>Variasi :</p>

                            @foreach ($product->variants as $item)
                                <label>
                                    <input type="radio" name="variant_id" class="card-input-variant"
                                        value="{{ $item->id }}" @click="setVariant({{ $item }})"
                                        @disabled($item->stock == 0)>
                                    <div class="d-flex">
                                        <div
                                            class="card card-variant @if ($item->stock == 0) bg-secondary @endif">
                                            <div class="card-body">
                                                {{ $item->name }}
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach

                            @error('variant_id')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                    @endif
                    <hr style="margin-top: -5px !important">
                    <div id="qty-modal" class="modal-body qty @if (count($product->variants) > 0) d-none @endif">
                        <div class="d-flex justify-content-between">
                            <p>Jumlah</p>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-minus btn-secondary"
                                    @click="decrement()">-</button>
                                <input type="text" name="quantity" class="form-control text-center" readonly
                                    :value="qty.value" style="width:55px; height:30px">
                                <button type="button" class="btn btn-sm btn-plus btn-secondary"
                                    @click="increment()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-content btn-sm text-white">Add to Cart</button>
                    </div>
                </form>
            </div>
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

        .card-input-variant {
            display: none;
        }

        .d-flex .card-variant {
            cursor: pointer;
        }

        .d-flex .card-variant .card-body {
            border-radius: 5px;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .card-input-variant:checked+.d-flex .card-variant {
            background-color: #198754;
            color: #e5e5e5;
        }
    </style>
@endpush

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();

            },
            data: {
                activePhoto: 0,
                photos: [

                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ asset($gallery->image) }}",
                        },
                    @endforeach
                ],

            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });

        var cartModal = new Vue({
            el: "#addCartModal",
            data: {
                qty: {
                    value: 1,
                    min: 1,
                    max: {{ $product->stock }},
                },
            },
            methods: {
                increment() {
                    if (this.qty.value < this.qty.max) {
                        this.qty.value++;
                    }

                    console.log(this.qty.max)
                },
                decrement() {
                    if (this.qty.value > this.qty.min) {
                        this.qty.value--;
                    }
                },

                closeModal() {
                    $('#addCartModal').modal('hide');
                },

                setVariant(variant) {
                    this.qty.max = variant.stock;
                    $(`#qty-modal`).removeClass('d-none');
                }
            },
        });
    </script>
@endpush
