@extends('layouts.app')

@section('title')
    Store Homepage
@endsection
@section('content')
    <section class="dashboard-user mt-5">
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-3">
                    <div class="d-flex justify-content-center">
                        <img src="https://picsum.photos/200" alt="Foto Profil" class="profile-pic rounded-circle" />
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button class="btn btn-light border-1" onclick="refreshImage()">
                            <i class="fas fa-sync-alt" style="color: #c9c9c9"></i>
                        </button>
                        <button class="btn btn-light" onclick="deleteImage()">
                            <i class="fa-solid fa-xmark" style="color: #c9c9c9"></i>
                        </button>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row mb-5">
                        <div class="col-12">
                            <form action="">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Your Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="Papel La Casa" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Your Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="email@gmail.com" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="addressOne">Address 1</label>
                                                    <input type="text" class="form-control" id="addressOne"
                                                        name="addressOne" value="Setra Duta Cemara" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="addressTwo">Address 2</label>
                                                    <input type="text" class="form-control" id="addressTwo"
                                                        name="addressTwo" value="Blok B2 No. 34" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="province">Province</label>
                                                    <select name="province" id="province" class="form-select">
                                                        <option value="West Java">West Java</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <select name="city" id="city" class="form-select">
                                                        <option value="Bandung">Bandung</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="postalCode">Postal Code</label>
                                                    <input type="text" class="form-control" id="postalCode"
                                                        name="postalCode" value="40512" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country"
                                                        value="Indonesia" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                                        value="+628 2020 11111" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-end">
                                                <button type="submit" class="btn btn-success px-5">
                                                    Save Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mt-2 mb-5">
                                <h5 class="mb-3">Recent Transactions</h5>
                                <a class="card card-list d-block" href="/dashboard-transactions-details.html">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="" />
                                            </div>
                                            <div class="col-md-4">Shirup Marzzan</div>
                                            <div class="col-md-3">Angga Risky</div>
                                            <div class="col-md-3">12 Januari, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="card card-list d-block" href="/dashboard-transactions-details.html">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-2.png" alt="" />
                                            </div>
                                            <div class="col-md-4">LeBrone X</div>
                                            <div class="col-md-3">Masayoshi</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="card card-list d-block" href="/dashboard-transactions-details.html">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-3.png" alt="" />
                                            </div>
                                            <div class="col-md-4">Soffa Lembutte</div>
                                            <div class="col-md-3">Shayna</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
