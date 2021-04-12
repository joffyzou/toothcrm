<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body>
<div class="layui-layout layui-layout-admin">
    @include('layouts._header')
    @include('layouts._side')

    <div class="layui-body">
        @yield('content')
    </div>

    @include('layouts._footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    layui.use('element', function(){
    var element = layui.element;

    });
</script>
</body>
</html>
