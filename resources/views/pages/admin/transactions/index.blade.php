@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transaction
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result starts from the small one
                </p>
            </div>
            <div class="dashboard-content">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="sell-tab" data-bs-toggle="pill" href="#sell" role="tab"
                            aria-controls="sell" aria-selected="true">Sell Product</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab">
                        <div class="row mt-3">
                            @foreach ($transaction as $item)
                                <div class="col-12 mt-2">
                                    <a class="card card-list d-block" href="{{ route('admin.transaction.show',$item->id) }}">
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
        </div>
    </div>
@endsection
