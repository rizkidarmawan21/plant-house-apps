@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="container center-div">
                        <div class="col-lg-4">
                            <h2>
                                Memulai untuk jual beli <br />
                                dengan cara terbaru
                            </h2>
                            <form class="mt-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control " aria-describedby="nameHelp"
                                        v-model="user.name" autofocus />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control " aria-describedby="emailHelp"
                                        v-model="user.email" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" v-model="user.password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Password Confirm</label>
                                    <input type="password" v-model="user.password_confirmation" class="form-control" />
                                </div>

                                <a @click="register()" class="btn btn-success btn-block mt-4">
                                    Sign Up Now
                                </a>
                                <button type="submit" class="btn btn-signup btn-block mt-4">
                                    Back to Sign In
                                </button>
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

        var register = new Vue({
            el: "#register",
            data() {
                return {
                    user: {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                    }
                }
            },
            methods: {
                register() {
                    let registerData = {
                        name: this.user.name,
                        email: this.user.email,
                        password: this.user.password,
                        password_confirmation: this.user.password_confirmation,
                    }

                    axios.post('{{ route('register') }}', registerData)
                        .then(function(response) {
                            Vue.toasted.success(
                                "You are registered, please login", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 5000,
                                }
                            );

                            setTimeout(function() {
                                window.location.href = "/register/success";
                            }, 1000);
                        })
                        .catch(function(error) {
                            // check error name,email,password with add class in input is-invalid
                            
                            if (error.response.data.errors.name) {
                                Vue.toasted.error(
                                    error.response.data.errors.name[0], {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                            } else if (error.response.data.errors.email) {
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
