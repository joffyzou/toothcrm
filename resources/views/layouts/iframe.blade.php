<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{-- <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" /> --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div class="x-nav">
        <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a href="">演示</a>
          <a><cite>导航元素</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
          <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
        </a>
    </div>
    @yield('iframe-content')
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
