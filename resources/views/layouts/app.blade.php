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
    @include('layouts._header')
    @include('layouts._side')

    <div class="layui-body" style="padding:30px;">
        <div style="padding-bottom: 66px;">@yield('content')</div>
    </div>

    @include('layouts._footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>

</script>
@yield('scripts')
</body>
</html>

