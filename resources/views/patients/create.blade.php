@extends('layouts.app')

@section('content')
<form class="layui-form" action="{{ route('patients.store') }}" method="POST">
    @csrf
    @method('delete')
    <div class="layui-form-item">
        <label class="layui-form-label">患者姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入患者姓名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">患者电话</label>
        <div class="layui-input-inline">
            <input type="tel" name="title" required  lay-verify="required" placeholder="请输入患者电话" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">平台</label>
        <div class="layui-input-inline">
            <select name="city" lay-verify="required">
                <option value="">请选择平台</option>
                <option value="0">大众</option>
                <option value="1">表单</option>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux">辅助文字</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否预约</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="1" title="是">
            <input type="radio" name="sex" value="0" title="否" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否加微</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="1" title="是">
            <input type="radio" name="sex" value="0" title="否" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">咨询项目</label>
        <div class="layui-input-inline">
            <select name="city" lay-verify="required">
                <option value="">请选择咨询项目</option>
                <option value="0">洁牙</option>
                <option value="1">种植</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否到店</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="1" title="是">
            <input type="radio" name="sex" value="0" title="否" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">业绩</label>
        <div class="layui-input-inline">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入业绩" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">特殊备注</label>
        <div class="layui-input-inline">
            <textarea name="desc" placeholder="请输入内容" class="layui-textarea" cols="21"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
        </div>
    </div>
</form>
@endsection
