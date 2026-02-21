<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Agenda 2063 - The Africa We Want')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @if(file_exists(public_path('css/flagship.css')))
    <link rel="stylesheet" href="{{ asset('css/flagship.css') }}">
    @endif
    @stack('styles')
</head>
<body>

    @include('partials.topbar')

    @include('partials.header')

    @include('partials.navigation')

    @include('partials.campaign-overlay')

    @include('partials.education-overlay')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
