@extends('layouts.success')

@section('title')
    Shipping Success !
@endsection
@section('content')
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 ">
                        <div class="text-center">
                            <img src="/images/success.svg" alt="" class="mb-4" />
                            <h2>Yey, Pesanan kamu telah kamu terima !</h2>
                            <p>
                                Silahkan isi form review untuk produk yang kamu beli
                            </p>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('user.review.store', $transaction->id) }}" method="post">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        @error('review.*.message')
                                            <div class="text-danger my-4">
                                                Pesan wajib diisi
                                            </div>
                                        @enderror
                                        @foreach ($transaction->transactionDetails as $item)
                                            <div class="mb-4">
                                                <div class="col-12 d-flex gap-2">
                                                    <img src="{{ asset($item->product->galleries[0]->image) }}"
                                                        style="width:80px; height: 80px; object-fit: cover; object-position: center;"
                                                        class="cart-image rounded-3" />
                                                    <p>{{ $item->product->name }}</p>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <label for="">Review</label>
                                                    <textarea name="review[{{ $item->product->id }}][message]" class="form-control"
                                                        placeholder="Masukkan pesan kamu pada produk ini" required></textarea>
                                                </div>
                                            </div>
                                        @endforeach

                                        <button type="submit" class="btn btn-success">Kirim Review</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
