@extends('layouts.iframe')

@section('content')
<div class="layui-form" lay-filter="layuiadmin-app-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">添加回访</label>
        <div class="layui-input-inline">
            <input type="hidden" name="user_id" value="{{ $patient->user_id }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="text" name="repay" value="" lay-verify="required" placeholder="请输入回访内容" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-add" id="layuiadmin-app-form-add" value="确认添加">
    </div>
</div>

<ul class="layui-timeline" style="padding-left: 40px;">
@foreach ($repays as $repay)
    <li class="layui-timeline-item">
        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
        <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">{{ $repay->created_at }}</h3>
            <p>{{ $repay->repay }}</p>
        </div>
    </li>
@endforeach
</ul>
@endsection
