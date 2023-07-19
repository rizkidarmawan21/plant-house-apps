<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- style -->
    @stack('prepend-style') @include('includes.style') @stack('addon-style')
</head>

<body>
    <!-- Loading screen -->
    <div class="loading d-none" data-aos="fade-down">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @include('layouts.toast')
    <!-- navbar -->
    @include('includes.navbar')

    <!-- page content -->
    @yield('content')


    <!-- footer 1 -->
    @include('includes.footer')

    <!-- script -->
    @stack('prepend-script') @include('includes.script') @stack('addon-script')
</body>

</html>
