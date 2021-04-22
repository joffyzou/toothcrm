<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body>
<div class="layui-layout layui-layout-admin">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
