@extends('layouts.auth')

@section('content')
    {{-- <div class="page-content page-auth" id="login">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-0" />
                    </div>
                    <div class="container center-div">
                        <div class="col-lg-5">
                            <h2>
                                Belanja kebutuhan utama, <br />
                                menjadi lebih mudah
                            </h2>
                            <form class="mt-3">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" aria-describedby="emailHelp"
                                        v-model="user.email" autofocus/>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="user.password" />
                                </div>
                                <div class="d-grid gap-2">
                                    <a @click="login()" class="btn btn-success mt-4">
                                        Sign In to My Account
                                    </a>
                                    <a class="btn btn-outline-primary mt-2" href="{{ route('register') }}">
                                        Sign Up
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="page-content page-auth" id="login">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-0" />
                    </div>
                    <div class="container center-div">
                        <div class="col-lg-4">
                            <h2>
                                Belanja kebutuhan utama, <br />
                                menjadi lebih mudah
                            </h2>
                            <form class="mt-3">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" aria-describedby="emailHelp"
                                        v-model="user.email" autofocus />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="user.password" />
                                </div>
                                <div class="d-grid gap-2">
                                    <a @click="login()" class="btn btn-success mt-4">
                                        Sign In to My Account
                                    </a>
                                    <a class="btn btn-outline-primary mt-2" href="{{ route('register') }}">
                                        Sign Up
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted);

        var login = new Vue({
            el: "#login",
            data() {
                return {
                    user: {
                        email: '',
                        password: '',
                    }
                }
            },
            methods: {
                login() {
                    let data = {
                        email: this.user.email,
                        password: this.user.password,
                    }

                    axios.post('{{ route('login') }}', data)
                        .then(function(response) {
                            Vue.toasted.success(
                                "You are logged!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 5000,
                                }
                            );

                            setTimeout(function() {
                                window.location.href = "/";
                            }, 1000);
                        })
                        .catch((error) => {

                            this.user.password = '';
                            if (error.response.data.errors.email) {
                                Vue.toasted.error(
                                    error.response.data.errors.email[0], {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            } else if (error.response.data.errors.password) {
                                Vue.toasted.error(
                                    error.response.data.errors.password[0], {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            }
                        });
                }
            },
            mounted() {
                AOS.init();
            },

        });
    </script>
@endpush
