<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
    <script src="{{ mix('js/app.js') }}"></script>
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

<script src="/layuiadmin/xm-select.js"></script>
<script>
layui.use(['layer', 'table', 'form'], function () {
    var layer = layui.layer,
        table = layui.table,
        form = layui.form,
        $ = layui.$;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.deleteData = function (obj, url) {
        layer.confirm('确认删除吗？', function (index) {
            layer.close(index);
            var load = layer.load();
            $.post(url, {_method: 'delete', ids: [obj.data.id]}, function (res) {
                layer.close(load);
                layer.msg(res.msg, {time: 1500, icon: res.code === 0 ? 1 : 2}, function () {
                    if (res.code === 0) {
                        obj.del();
                    }
                })
            })
        })
    };

    //表单提交并关闭
    form.on('submit(go-close)', function (data) {
        var load = layer.load();
        $.post(data.form.action, data.field, function (res) {
            layer.close(load);
            var code = res.code
            layer.msg(res.msg, {time: 2000, icon: code === 0 ? 1 : 2}, function () {
                if (code === 0) {
                    parent.layer.close(parent.layer.getFrameIndex(window.name));
                }
            });
        });
        return false;
    });
    form.on('submit(go-close-refresh)', function (data) {
        var load = layer.load();
        $.post(data.form.action, data.field, function (res) {
            layer.close(load);
            var code = res.code
            layer.msg(res.msg, {time: 2000, icon: code === 0 ? 1 : 2}, function () {
                if (code === 0) {
                    layui.table.reload('dataTable');
                    layer.close(layer.getFrameIndex(window.name));
                }
            });
        });
        return false;
    })
})
</script>
@yield('scripts')
</body>
</html>

