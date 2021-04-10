@extends('layouts.app')

@section('content')
<div class="layui-col-md6">
    <div class="layui-panel">
        <form action="{{ route('admins.store') }}" method="POST" class="layui-form">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <label class="layui-form-label">登录名</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">岗位</label>
                <div class="layui-input-inline">
                    <select name="role">
                        <option value="">请选择岗位</option>
                        <option value="2">客服主管</option>
                        <option value="3">客服</option>
                        <option value="4">运营主管</option>
                        <option value="5">运营</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="password" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">添加</button>
                </div>
                </div>
        </form>
    </div>
</div>
@endsection
