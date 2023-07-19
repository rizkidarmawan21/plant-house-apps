@extends('layouts.app')

@section('title')
    Store Dashboard Transaction Details
@endsection
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="dashboard-heading">
                    <h2 class="dashboard-title">{{ $transaction->invoice_code }}</h2>
                    <p class="dashboard-subtitle">Transaction Details</p>
                </div>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <table class="table table-borderless table-cart" aria-describedby="Cart">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($transaction->transactionDetails as $detail)
                                            <tr id="cart">
                                                <td style="width: 20%">
                                                    <img src="{{ asset($detail->product->galleries->first()->image) }}"
                                                        style="width:80px; height: 80px; object-fit: cover; object-position: center;"
                                                        class="cart-image rounded-3" />
                                                </td>
                                                <td style="width: 20%">
                                                    <div class="product-title">
                                                        {{ $detail->product->name }}
                                                        <br>
                                                        {{ $detail->variant ? 'Variant : ' . $detail->variant->name : '' }}
                                                    </div>
                                                </td>
                                                <td style="width: 20%">
                                                    Rp.
                                                    {{ number_format($detail->variant->price ?? $detail->product->price) }}
                                                    <div class="product-subtitle">IDR</div>
                                                </td>
                                                <td style="width: 20%">
                                                    <div class="product-title">
                                                        {{ $detail->qty }}x
                                                    </div>
                                                </td>
                                                <td style="width: 20%">
                                                    <div class="product-title">Rp.
                                                        {{ number_format(($detail->variant->price ?? $detail->product->price) * $detail->qty) }}
                                                    </div>
                                                </td>
                                            </tr>

                                            @php
                                                $total += ($detail->variant->price ?? $detail->product->price) * $detail->qty;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3"></td>
                                            <td align="right"><b>Total Pembelian:</b></td>
                                            <td align="left">Rp. {{ number_format($total) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td align="right"><b>Ongkos Kirim :</b></td>
                                            <td align="left">Rp.
                                                {{ number_format($transaction->transactionShipping->shipping_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td align="right"><b>Total :</b></td>
                                            <td align="left">Rp. {{ number_format($transaction->total_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td align="right"><b>Status :</b></td>
                                            <td align="left">
                                                @if ($transaction->payment_status == 'pending')
                                                    <span
                                                        class="badge bg-warning text-light">{{ $transaction->payment_status }}</span>
                                                @elseif($transaction->payment_status == 'paid')
                                                    <span
                                                        class="badge bg-success text-light">{{ $transaction->payment_status }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger text-light">{{ $transaction->payment_status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Shipping Informations</h5>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title fw-bold">Status <span
                                            class="badge bg-info text-light">{{ $transaction->shipping_status }}</span>
                                    </div>
                                    <div class="product-subtitle">
                                        @if ($transaction->shipping_status == 'pending')
                                            Penjual sedang menyiapkan barang untuk dikirim <a class="text-decoration-none"
                                                href="">Hubungi penjual</a>
                                        @elseif ($transaction->shipping_status == 'shipping')
                                            Penjual telah mengirimkan paket ke saja kurir
                                        @endif
                                    </div>
                                </div>
                                @if ($transaction->shipping_status == 'shipping')
                                    <div class="col-12 col-md-12 mb-3">
                                        <div class="product-title text-secondary fw-bold">Nomor Resi</div>
                                        <div class="product-subtitle">
                                            {{ $transaction->resi_number }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Alamat</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>

                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Nomor Telepon</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Detail Lainnya</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Provinsi</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Kota</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Kode POS</div>
                                    <div class="product-subtitle">
                                        Setra Duta Cemara
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Dikirim dari</div>
                                    <div class="product-subtitle">
                                        Kota Semarang
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Kurir</div>
                                    <div class="product-subtitle">
                                        JNE
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="product-title text-secondary fw-bold">Service</div>
                                    <div class="product-subtitle">
                                        OKE - Ongkos Kirim Ekonomis (2-3)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
    @endsection

    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script>
            var transactionDetails = new Vue({
                el: "#transactionDetails",
                data: {
                    status: "SHIPPING",
                    resi: "BDO12308012132",
                },
            });
        </script>
    @endpush
