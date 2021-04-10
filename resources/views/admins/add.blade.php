@extends('layouts.iframe')

@section('iframe-content')
<div class="layui-fluid">
    <div class="layui-row">
        <form action="{{ route('admins.store') }}" method="POST" class="layui-form">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>登录名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="username" required="" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>岗位
                </label>
                <div class="layui-input-inline">
                    <select id="role" name="role" class="valid">
                        <option value="2">客服主管</option>
                        <option value="3">客服</option>
                        <option value="4">运营主管</option>
                        <option value="5">运营</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="password" required="" lay-verify="pass" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">增加</button>
            </div>
      </form>
    </div>
</div>
@endsection
