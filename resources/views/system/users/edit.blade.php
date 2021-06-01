@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <form action="{{ route('system.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATH')
            <div class="layui-form-item">
                <label for="" class="layui-form-label">帐号</label>
                <div class="layui-input-block">
                    <input type="text" maxlength="16" name="username" value="{{ $user->username ?? old('username') }}" lay-verify="required" placeholder="请输入帐号" class="layui-input" >
                </div>
            </div>
            <div class="layui-form-item">
                <label for="" class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" maxlength="16" name="password" placeholder="请输入密码，不修改则留空" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="" class="layui-form-label">角色</label>
                <div class="layui-input-block">
                    @include('commons.get_role_by_user_id',['user_id'=>$user->id])
                </div>
            </div>
            <div class="layui-form-item">
                <label for="" class="layui-form-label">部门</label>
                <div class="layui-input-block">
                    @include('commons.get_department_by_user_id',['user_id' => $user->id])
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-sm" lay-submit="" lay-filter="go-close-refresh">确 认</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
