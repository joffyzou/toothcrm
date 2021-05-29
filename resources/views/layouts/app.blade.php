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
    <div class="layui-body">
        <div class="layui-fluid">
            @yield('content')
        </div>
    </div>
    @include('layouts._footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
layui.use(['layer', 'table'], function () {
    var layer = layui.layer,
        table = layui.table,
        $ = layui.$;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.deleteData = function (obj, url, tableName) {
        layer.confirm('确认删除吗？', function (index) {
            layer.close(index);
            var load = layer.load();
            $.post(url, {_method: 'delete', ids: [obj.data.id]}, function (res) {
                layer.close(load);
                layer.msg(res.msg, {time: 1500, icon: res.code === 0 ? 1 : 2}, function () {
                    if (res.code === 0) {
                        obj.del();
                        table.reload(tableName);
                    }
                })
            })
        })
    }
})
</script>
@yield('scripts')
</body>
</html>

