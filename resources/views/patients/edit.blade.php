@extends('layouts.iframe')

@section('content')

<div class="layui-form" style="padding: 20px 70px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">电话</label>
        <div class="layui-input-inline">
            <input type="tel" name="email" lay-verify="email" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">平台</label>
        <div class="layui-input-inline">
            <select name="interest" lay-filter="aihao">
                <option value="0">写作</option>
                <option value="1">阅读</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">咨询项目</label>
        <div class="layui-input-inline">
            <select name="interest" lay-filter="aihao">
                <option value="0">写作</option>
                <option value="1">阅读</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">业绩</label>
        <div class="layui-input-inline">
            <input type="tel" name="email" lay-verify="email" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">来源</label>
        <div class="layui-input-inline">
            <input type="tel" name="email" lay-verify="email" autocomplete="off" class="layui-input">
        </div>
    </div>
</div>

@endsection

