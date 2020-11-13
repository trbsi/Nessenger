<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
<div class="wrapper">
    @include('home.navbar')
    @include('home.messages')
</div>
@livewireScripts
<script src="{{ asset('js/jquery3.min.js') }}"></script>
<!-- highlight keywords -->
<script src="{{ asset('js/jquery.mark.min.js') }}" defer></script>
<!-- laravel js -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- something for tailwind -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{ asset('js/messages.js') }}"></script>

@stack('js')
</body>
</html>
