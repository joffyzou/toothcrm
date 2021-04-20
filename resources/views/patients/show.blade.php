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
    <div class="layui-form" lay-filter="layuiadmin-app-list" id="layuiadmin-app-form-list"
         style="padding: 20px 30px 0 0;">
        <div class="layui-form-item">
            <label class="layui-form-label">添加回访</label>
            <div class="layui-input-inline">
                <input type="hidden" name="admin_id" value="{{ $patient->admin_id }}">
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="text" name="repay" value="" lay-verify="required"
                       placeholder="请输入回访内容" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-hide">
            <input type="button" lay-submit lay-filter="layuiadmin-app-form-add" id="layuiadmin-app-form-add"
                   value="确认添加">
        </div>
    </div>
    <ul class="layui-timeline">
    @foreach ($patient->repays as $item)
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">{{ $item->created_at }}</h3>
                <p>{{ $item->repay }}</p>
            </div>
        </li>
    @endforeach
    </ul>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
