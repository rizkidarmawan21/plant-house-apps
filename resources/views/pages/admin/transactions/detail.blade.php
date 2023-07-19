@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transaction Details
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">#STORE0839</h2>
                <p class="dashboard-subtitle">Transaction Details</p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-3">
                                    <div class="col-12 col-md-7">
                                        @foreach ($transaction->transactionDetails as $item)
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-2">
                                                    <img style="width:100px; height: 100px; object-fit: cover; object-position: center;"
                                                        class="cart-image rounded-3"
                                                        src="{{ asset($item->product->galleries[0]->image) }}"
                                                        alt="" />
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">Product Name</div>
                                                    <div class="product-subtitle">
                                                        {{ $item->product->name }}
                                                        <br>
                                                        {{  $item->variant ? "Variant: " .$item->variant->name : ''}}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">Price</div>
                                                    <div class="product-subtitle">{{ $item->variant->price ?? $item->product->price }} x
                                                        {{ $item->qty }}</div>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">Subtotal</div>
                                                    <div class="product-subtitle">Rp.
                                                        {{ number_format(($item->variant->price ?? $item->product->price) * $item->qty) }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 col-md-5 ">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="product-title">Shipping Cost</div>
                                                <div class="product-subtitle">Rp.
                                                    {{ number_format($transaction->transactionShipping->shipping_price) }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">{{ $transaction->user->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="product-title">Total Payment</div>
                                                <div class="product-subtitle">Rp.
                                                    {{ number_format($transaction->total_price) }}</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="product-title">Phone Number</div>
                                                <div class="product-subtitle">{{ $transaction->phone_number }}</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="product-title">Payment Status</div>
                                                <div class="product-subtitle">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-12 mt-4">
                                        <h5>Shipping Informations</h5>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->address }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address Detail</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->detail_address }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Province</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transactionShipping->province->province }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Postal Code</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transactionShipping->city->postal_code }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">City</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transactionShipping->city->type }}
                                                    {{ $transaction->transactionShipping->city->city_name }}</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row p-3">
                                    <div class="col-12 mt-4">
                                        <h5>Courier Informations</h5>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Courier</div>
                                                <div class="product-subtitle text-uppercase">
                                                    {{ $transaction->transactionShipping->courier }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Service</div>
                                                <div class="product-subtitle text-uppercase">
                                                    {{ $transaction->transactionShipping->service }} -
                                                    {{ $transaction->transactionShipping->service_description }}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="product-title">Status</div>
                                                        <select name="status" id="status" class="form-control"
                                                            v-model="status">
                                                            <option value="pending">Pending</option>
                                                            <option value="shipping">Shipping</option>
                                                            <option value="success">Success</option>
                                                        </select>
                                                    </div>
                                                    <template v-if="status == 'shipping'">
                                                        <div class="col-md-4">
                                                            <div class="product-title">
                                                                Input Resi
                                                            </div>
                                                            <input class="form-control" type="text" name="resi"
                                                                id="openStoreTrue" v-model="resi" />
                                                        </div>
                                                    </template>
                                                    <div class="col-md-4">
                                                        <button type="submit" @click="updateResi()"
                                                            class="btn btn-success btn-block mt-4">
                                                            Update Resi & Status
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted);
        var transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->resi_number }}",
            },
            methods: {
                updateResi() {
                    var self = this;
                    var id = "{{ $transaction->id }}";
                    axios.put('{{ route('admin.transaction.update', $transaction->id) }}', {
                            shipping_status: this.status,
                            resi: this.resi,
                        })
                        .then(function(response) {
                            Vue.toasted.success(
                                response.data.message, {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 5000,
                                }
                            );
                        })
                        .catch(function(error) {
                            if (error.response.data.message) {
                                Vue.toasted.error(
                                    error.response.data.message, {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            }

                        });
                }
            },
        });
    </script>
@endpush
