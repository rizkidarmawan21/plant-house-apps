@extends('layouts.dashboard')

@section('title')
    Store Dashboard Article
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Article</h2>
                <p class="dashboard-subtitle">
                    List of My Article
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.article.create') }}" class="btn btn-success">Add Article</a>
                    </div>
                </div>
                <div class="row mt-4 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($articles as $item)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration }}
                                            </th>
                                            <td>
                                                {{ Carbon\Carbon::parse($item->created_at)->format('d, F Y') }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($item->image) }}" alt="" style="width: 150px"
                                                    class="img-thumbnail" />
                                            </td>
                                            <td>
                                                {{ $item->author }}
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {!! $item->description !!}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 text-center">
                                                    <a href="{{ route('admin.article.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm" type="button">Edit</a>
                                                    <form action="{{ route('admin.article.destroy', $item->id) }}"
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
                                            <th colspan="7" class="text-center py-3 text-secondary">Belum ada data
                                                artikel</th>
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
