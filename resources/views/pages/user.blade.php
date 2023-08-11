@extends('layouts.app')

@section('title')
    Store Homepage
@endsection
@section('content')
    <section class="dashboard-user mt-5" style="min-height: 70vh">
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-3">
                    <div class="d-flex justify-content-center">
                        @if (auth()->user()->photo)
                            <img src="{{ auth()->user()->photo }}"
                                alt="Foto Profil" class="picture-pic rounded-circle" style="width: 200px; height:200px; background-size: cover" />
                        @else
                            <img src="https://cdn5.vectorstock.com/i/1000x1000/73/54/blank-photo-icon-vector-29557354.jpg"
                                alt="Foto Profil" class="picture-pic rounded-circle" style="width: 200px; height:200px" />
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row mb-5">
                        <div class="col-12">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Your Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ auth()->user()->name }}" />
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Your Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ auth()->user()->email }}" />
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="photo">Your Photo</label>
                                                    <input type="file" class="form-control" id="photo"
                                                        name="photo" />
                                                    @error('photo')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Update Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                        name="password" value="" />
                                                    @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
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
                </div>
            </div>
        </div>
    </section>
@endsection
