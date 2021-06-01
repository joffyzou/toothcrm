<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body>
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h1>Toothcrm Admin</h1>
        </div>
        <form action="{{ route('admin.login') }}" method="POST" class="layui-form">
            @csrf
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                    <input type="text" name="username" id="LAY-user-login-username" placeholder="用户名" class="layui-input" value="{{ old('username') }}">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" placeholder="密码" class="layui-input" value="{{ old('password') }}">
                </div>
                <div class="layui-form-item">
                    <button type="submit" class="layui-btn layui-btn-fluid">登 入</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
