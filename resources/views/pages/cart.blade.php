@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection
@section('content')
    <div class="page-content page-cart" id="detail-shipping">
        <section class="store-breadcumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="Cart">
                            <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $item)
                                    <tr id="cart">
                                        <td style="width: 25%">
                                            <img src="{{ asset($item->product->galleries[0]->image) }}"
                                                style="width:200px; height: 200px; object-fit: cover; object-position: center;"
                                                class="cart-image" />
                                        </td>
                                        <td style="width: 20%">
                                            <div class="product-title">
                                                {{ $item->product->name }}

                                                @if ($item->variant)
                                                    <br>
                                                    Variant : {{ $item->variant->name }}
                                                @endif
                                            </div>
                                            <span class="d-none"
                                                id="stock-{{ $item->id }}">{{ $item->variant ? $item->variant->stock : $item->product->stock }}</span>
                                        </td>
                                        <td style="width: 20%">
                                            <div class="d-flex gap-2 mt-3">
                                                <button type="button" id="btn-minus-{{ $item->id }}"
                                                    class="btn btn-sm btn-minus btn-secondary"
                                                    @click="decrement({{ $item->id }},1)">-</button>
                                                <input type="text" id="qty-{{ $item->id }}" name="quantity"
                                                    class="form-control text-center" value="{{ $item->quantity }}" readonly
                                                    style="width:50px; height:30px">
                                                <button type="button" class="btn btn-sm btn-plus btn-secondary"
                                                    @click="increment({{ $item->id }},{{ $item->variant ? $item->variant->stock : $item->product->stock }})">+</button>
                                            </div>
                                        </td>
                                        <td style="width: 10%">
                                            <div class="product-title">Rp.
                                                <span
                                                    id="price-{{ $item->id }}">{{ number_format($item->variant ? $item->variant->price : $item->product->price) }}</span>
                                            </div>
                                            <div class="product-subtitle">IDR</div>
                                        </td>
                                        <td style="width: 35%">
                                            <div class="product-title">Rp.
                                                <span
                                                    id="subtotal-{{ $item->id }}">{{ number_format(($item->variant ? $item->variant->price : $item->product->price) * $item->quantity) }}</span>
                                            </div>
                                        </td>
                                        <td style="width: 20%">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-remove-cart btn-sm align-self-center">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-5 text-center">Kamu belum memiliki produk</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Detail Belanja</h2>
                    </div>
                </div>
                <div>
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="addressOne">Alamat</label>
                                <input type="text" class="form-control" id="addressOne" aria-describedby="emailHelp"
                                    name="addressOne" v-model="checkout.address" required />
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="mobile">No.Telepon</label>
                                <input type="number" class="form-control" id="mobile" name="mobile"
                                    v-model="checkout.phone_number" required />
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="addressTwo">Detail Lainnya</label>
                                <input type="text" class="form-control" id="addressTwo" name="addressTwo"
                                    v-model="checkout.detail_address" required />
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                @{{ province_id }}
                                <select name="province" id="province" class="form-control" required
                                    v-model.lazy="selectedProvince" @change="handleProvinceChange">
                                    <option value="">-- Pilih Provinsi --</option>
                                    {{-- make loop with v-for of option --}}
                                    <option v-for="item in provinces" :key="item.province_id" :value="item.province_id">
                                        @{{ item.province }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="city">Kota</label>
                                <select name="city" id="city" class="form-control" v-model.lazy="selectedCity"
                                    @change="handleCityChange" required>
                                    <option value="">-- Pilih Kota --</option>
                                    <option v-for="item in cities" :key="item.id" :value="item.city_id">
                                        @{{ item.type }} @{{ item.city_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="postalCode">Kode Pos</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode"
                                    :value="city.postal_code" required />
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2>Jasa Pengiriman</h2>
                        </div>
                    </div>
                    <div v-if="isLoading" class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden text-center">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="row d-flex justify-content-evenly">
                        <div v-for="(item,index) in courier" :key="index" class="col-md-3 card"
                            @click="modalService(item.costs,item.code)"
                            v-if="item.costs.length > 0 && selectedService.length === 0">
                            <div class="card-body">
                                <div class="product-title text-uppercase">@{{ item.code }}</div>
                                <div class="product-subtitle">@{{ item.name }}</div>
                            </div>
                        </div>

                        <div class="row" v-if="Object.keys(this.selectedService).length > 0">
                            <div class="col-4 col-md-2">
                                <div class="product-title text-uppercase">@{{ selectedService.code }}</div>
                                <div class="product-subtitle">Jasa</div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="product-title">@{{ selectedService.service }}</div>
                                <div class="product-subtitle">Layanan</div>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="product-title">@{{ selectedService.etd }}</div>
                                <div class="product-subtitle">Estimasi</div>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="product-title">@{{ rupiah(selectedService.cost) }}</div>
                                <div class="product-subtitle">Ongkir</div>
                            </div>
                            <div class="col-8 col-md-3">
                                <a @click="resetOngkir" class="btn btn-success mt-3 px-4 btn-block">
                                    Ubah Jasa
                                </a>
                            </div>
                        </div>


                        {{-- Modal select service courier --}}
                        <div class="modal fade" id="modalService" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase">@{{ code }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-3" v-for="item in courier_service">
                                            <div class="card-body">
                                                <p>@{{ item.service }} - @{{ item.description }}</p>
                                                <p class="text-secondary" v-if="item.cost[0].etd.includes('HARI')">
                                                    Estimasi @{{ item.cost[0].etd.replace('HARI', '') }} Hari
                                                </p>
                                                <p class="text-secondary" v-else>Estimasi @{{ item.cost[0].etd }} Hari</p>
                                                <p class="text-secondary">Biaya @{{ rupiah(item.cost[0].value) }}</p>

                                                {{-- make button selected service --}}
                                                <button class="btn btn-success btn-block"
                                                    @click="handleSelectedService(item.cost[0].value,item.service,item.description,item.cost[0].etd)">
                                                    Pilih
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2>Informasi Pembayaran</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class=" col-md-3">
                            <div class="product-title">@{{ rupiah(total_transaction) }}</div>
                            <div class="product-subtitle">Total pembelian</div>
                        </div>
                        <div class=" col-md-3">
                            <div class="product-title">@{{ rupiah(selectedService.cost) }}</div>
                            <div class="product-subtitle">Biaya pengiriman</div>
                        </div>
                        <div class=" col-md-3">
                            <div class="product-title text-success">@{{ rupiah(total_payment) }}</div>
                            <div class="product-subtitle">Total Pembayaran</div>
                        </div>
                        <div class=" col-md-3">
                            <button type="submit" class="btn btn-success mt-3 px-4 btn-block"
                                :disabled="total_payment == 0" @click="CheckoutProcess()">
                                Checkout Now

                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </section>
    </div>
@endsection

@push('addon-style')
    <style>
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

        ,
    </style>
@endpush


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted);
        var detailShipping = new Vue({
            el: "#detail-shipping",
            data: {
                checkout: {
                    address: "",
                    detail_address: "",
                    phone_number: "",
                },
                provinces: [],
                cities: [],
                selectedProvince: '',
                selectedCity: '',
                city: [],
                courier: [],
                isLoading: false,
                courier_service: [],
                selectedService: {},
                code: '', // code courier
                total_transaction: 0,
                total_payment: 0,
            },
            methods: {
                rupiah(number) {
                    if (number == null) {
                        return "Rp. 0";
                    }
                    return new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    }).format(number);
                },
                getProvinces() {
                    axios.get("{{ route('ongkir.get-province') }}")
                        .then((response) => {
                            this.provinces = response.data.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },

                handleProvinceChange() {
                    // get axios city by province_id
                    axios.get("{{ route('ongkir.get-city') }}?province_id=" + this.selectedProvince)
                        .then((response) => {
                            this.cities = response.data.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },

                handleCityChange() {
                    axios.get("{{ url('ongkir/get-city') }}/" + this.selectedCity)
                        .then((response) => {
                            this.city = response.data.data;
                            this.checkOngkir();
                            this.total_payment = 0;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },
                checkOngkir() {
                    if (this.selectedCity) {
                        this.isLoading = true;
                        // reset selectedService
                        this.selectedService = [];
                        axios.get("{{ route('ongkir.get-cost') }}", {
                                params: {
                                    city_id: this.selectedCity
                                }
                            })
                            .then((response) => {
                                // Lakukan sesuatu dengan data ongkir yang diterima dari API
                                this.courier = response.data.data;
                                this.isLoading = false;

                            })
                            .catch((error) => {
                                Vue.toasted.error(
                                    error.response.data.message, {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            });
                    }
                },

                modalService(costs, code) {
                    this.courier_service = costs;
                    this.code = code;

                    $('#modalService').modal('show');
                },

                handleSelectedService(cost, service, description, etd) {
                    $('#modalService').modal('hide');
                    this.selectedService = {
                        code: this.code,
                        cost: cost,
                        service: service,
                        description: description,
                        etd: etd,
                    }

                    this.getTotalPayment();
                },
                resetOngkir() {
                    this.selectedService = [];
                    this.total_payment = 0
                },
                getTotalTransaction() {
                    this.total_transaction = 0;
                    var subtotals = document.querySelectorAll('[id^="subtotal-"]');
                    for (var i = 0; i < subtotals.length; i++) {
                        var subtotalText = subtotals[i].textContent;
                        var subtotalValue = parseFloat(subtotalText.replace(/[^\d.-]/g, ''));
                        this.total_transaction += subtotalValue;
                    }
                },
                getTotalPayment() {
                    this.total_payment = this.total_transaction + this.selectedService.cost ?? 0;
                    // console.log('total' + this.total_payment);
                },
                increment(id, max_stock) {
                    $(`#btn-minus-${id}`).removeAttr('disabled');

                    let qty = $(`#qty-${id}`);

                    if (qty.val() >= max_stock) {
                        $(`#btn-plus-${id}`).prop('disabled', true);
                    } else {
                        let count = parseInt(qty.val(), 10); // Menambahkan basis 10 untuk parsing ke integer
                        qty.val(count + 1 || 0); // Menambahkan penanganan jika parsing gagal

                        this.updateQuantity(id, 'increment', qty.val());

                    }
                },
                decrement(id, min_stock) {
                    // enable btn - plus
                    $(`#btn-plus-${id}`).removeAttr('disabled');

                    let qty = $(`#qty-${id}`);
                    let count = parseInt(qty.val());
                    count = count > 1 ? count - 1 : 1; // Memastikan nilai decrement minimum adalah 1

                    qty.val(count);

                    this.updateQuantity(id, 'decrement', qty.val());
                    if (count === 1) {
                        $(`#btn-minus-${id}`).prop('disabled', true); // Menonaktifkan tombol minus
                    }
                },
                updateQuantity(id, type, qty) {
                    axios.post("{{ url('cart/update') }}/" + id, {
                        type: type
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then((res) => {
                        this.updateSubtotal(id, qty)
                        this.getTotalTransaction()
                    }).catch((err) => {
                        console.log(res)
                    })
                },
                updateSubtotal(id, qty) {
                    const priceElement = $(`#price-${id}`);
                    const priceText = priceElement.text().replace('Rp. ', '').replace(',', '');
                    const price = parseFloat(priceText);
                    const newSubtotal = qty * price;
                    const subtotalElement = $(`#subtotal-${id}`);
                    subtotalElement.text(`${newSubtotal.toLocaleString()}`);
                },
                CheckoutProcess() {

                    // get class is name loading and remove class d-none
                    $('.loading').removeClass('d-none');

                    let data = {
                        address: this.checkout.address,
                        detail_address: this.checkout.detail_address,
                        phone_number: this.checkout.phone_number,
                        city_id: this.selectedCity,
                        courier: this.selectedService.code,
                        service: this.selectedService.service,
                        service_description: this.selectedService.description,
                        etd: this.selectedService.etd,
                        shipping_price: this.selectedService.cost,
                    }

                    setTimeout(
                        axios.post("{{ route('checkout.process') }}", data)
                        .then((response) => {
                            // redirect in payment url midtrans
                            window.location.href = response.data.payment_url;

                            // get class is name loading and add class d-none
                            $('.loading').addClass('d-none');
                        })
                        .catch((error) => {
                            $('.loading').addClass('d-none');
                            if (error.response.data.message) {
                                Vue.toasted.error(
                                    error.response.data.message, {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            }

                            let errors = error.response.data.meta.error;

                            // loop error with vue toast
                            for (const [key, value] of Object.entries(errors)) {
                                Vue.toasted.error(
                                    value[0], {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            }


                        }), 5000);
                }
            },
            mounted() {
                AOS.init();
                this.getProvinces();
                this.checkOngkir();
                this.getTotalTransaction();
            },
        });
    </script>
@endpush
