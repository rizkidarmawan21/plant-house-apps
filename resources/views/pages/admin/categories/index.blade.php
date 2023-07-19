@extends('layouts.dashboard')

@section('title')
    Store Dashboard Category
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Category</h2>
                <p class="dashboard-subtitle">
                    List of My Category
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success">Add Category</a>
                    </div>
                </div>
                <div class="row mt-4 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td width="70%">
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 text-center">
                                                    <a href="{{ route('admin.category.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm" type="button">Edit</a>
                                                    <form action="{{ route('admin.category.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="3" class="text-center py-3 text-secondary">Belum ada data
                                                category</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
