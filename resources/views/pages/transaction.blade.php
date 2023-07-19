@extends('layouts.app')

@section('title')
    Store Homepage
@endsection
@section('content')
    <section class="dashboard-user mt-5" style="min-height: 60vh">
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mt-2 mb-5">
                                <h5 class="mb-3">My Transactions</h5>
                                <?php
                                $item_selected = 0;
                                ?>
                                @forelse ($transactions as $transaction)
                                    <div class="card card-list d-block mb-3">
                                        <div class="card-body">
                                            <div class="row ms-5">
                                                <div class="col-md-2">
                                                    {{ $transaction->created_at }}
                                                </div>
                                                <div class="col-md-2">
                                                    {{ $transaction->invoice_code }}
                                                    <br>
                                                    @if ($transaction->payment_status == 'pending')
                                                        <a target="blank" href="{{ $transaction->midtrans_url }}"
                                                            class="text-danger">Bayar
                                                            Sekarang</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <span>Status Pembayaran</span>
                                                    <br>
                                                    <span
                                                        class="text-uppercase @if ($transaction->payment_status === 'paid') text-success @endif @if ($transaction->payment_status === 'pending') text-warning @endif">
                                                        {{ $transaction->payment_status }}
                                                    </span>
                                                </div>
                                                <div class="col-md-2">
                                                    <span>Status Pengiriman</span>
                                                    <br>
                                                    <span
                                                        class="text-uppercase @if ($transaction->shipping_status === 'success') text-success @endif @if ($transaction->shipping_status === 'pending' or $transaction->shipping_status === 'shipping') text-warning @endif ">
                                                        {{ $transaction->shipping_status }}
                                                    </span>
                                                </div>

                                                <div class="col-md-2">
                                                    Rp. {{ number_format($transaction->total_price) }}
                                                </div>
                                                <a href="{{ route('user.transaction.show', $transaction->id) }}"
                                                    class="col-md-1 d-none d-md-block">
                                                    <img src="/images/dashboard-arrow-right.svg" alt="" />
                                                </a>

                                                @if ($transaction->shipping_status == 'shipping')
                                                    <?php $item_selected = $transaction->id; ?>
                                                    <a data-bs-toggle="modal" data-bs-target="#terimaPesananModal"
                                                        type="submit" class="col-md-1 d-none d-md-block text-success">
                                                        <img src="/images/check.svg" alt="" />
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card card-list d-block" href="/dashboard-transactions-details.html">
                                        <div class="card-body text-center">
                                            <p>Yah sepertinya kamu belum melakukan transaksi apapun, yuk bisa segera
                                                checkout !</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Verif Terima Pesanan-->
        <div class="modal fade" id="terimaPesananModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <h4>Yakin anda telah menerima pesanan ?</h4>
                        <div class="mt-5 d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Belum!</button>
                            <form action="{{ route('user.transaction.acceptShipping', $item_selected) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">Ya, saya telah menerima!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
