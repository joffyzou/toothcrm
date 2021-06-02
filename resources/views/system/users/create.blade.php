@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        添加用户
    </div>
    <div class="layui-card-body">
        <form action="{{ route('system.users.store') }}" method="POST" class="layui-form">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="role" class="layui-form-label">角色</label>
                <div class="layui-input-inline">
                    @include('commons.get_role_by_user_id')
                </div>
            </div>

            <div class="layui-form-item">
                <label for="role" class="layui-form-label">部门</label>
                <div class="layui-input-inline">
                    @include('commons.get_department_by_user_id')
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
