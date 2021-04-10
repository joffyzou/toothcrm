<!DOCTYPE html>
<html class="x-admin-sm" lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ mix('css/login.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body class="login-bg">
    <div class="login layui-anim layui-anim-up">
        <div class="message">x-admin2.0-管理登录</div>
        <div id="darkbannerwrap"></div>
        <form action="{{ route('admin.login') }}" method="POST" class="layui-form">
            {{ csrf_field() }}
            <input name="username" type="text" lay-verify="required" class="layui-input" placeholder="用户名">
            <hr class="hr15">
            <input name="password" type="password" lay-verify="required" class="layui-input" placeholder="密码">
            <hr class="hr15">
            <input type="submit" value="登录" lay-submit lay-filter="login" style="width:100%;">
            <hr class="hr20" >
        </form>
    </div>
</body>
</html>
