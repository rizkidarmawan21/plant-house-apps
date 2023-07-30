@extends('layouts.dashboard')

@section('title')
    Store Dashboard Admin
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Revenue</div>
                                <div class="dashboard-card-subtitle">Rp. {{ number_format($revenue) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Transaction</div>
                                <div class="dashboard-card-subtitle">{{ number_format($total_transaction) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">My Product</div>
                                <div class="dashboard-card-subtitle">{{ number_format($total_product) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    @foreach ($recent_transaction as $item)
                        <div class="col-12 mt-2">
                            <a class="card card-list d-block" href="{{ route('admin.transaction.show', $item->id) }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img style="width:80px; height: 80px; object-fit: cover; object-position: center;"
                                                class="cart-image rounded-3"src="{{ asset($item->transactionDetails[0]->product->galleries[0]->image) }}"
                                                alt="" />
                                        </div>
                                        <div class="col-md-2">{{ $item->invoice_code }}</div>
                                        <div class="col-md-2">{{ $item->user->name }}</div>
                                        <div class="col-md-2">
                                            <span>Status Pembayaran</span>
                                            <br>
                                            <span
                                                class="text-uppercase @if ($item->payment_status === 'paid') text-success @endif @if ($item->payment_status === 'pending') text-warning @endif">
                                                {{ $item->payment_status }}
                                            </span>
                                        </div>
                                        <div class="col-md-2">
                                            <span>Status Pengiriman</span>
                                            <br>
                                            <span
                                                class="text-uppercase @if ($item->shipping_status === 'success') text-success @endif @if ($item->shipping_status === 'pending' or $item->shipping_status === 'shipping') text-warning @endif">
                                                {{ $item->shipping_status }}
                                            </span>
                                        </div>
                                        <div class="col-md-2">{{ $item->created_at }}</div>
                                        <div class="col-md-1 d-none d-md-block">
                                            <img src="/images/dashboard-arrow-right.svg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
