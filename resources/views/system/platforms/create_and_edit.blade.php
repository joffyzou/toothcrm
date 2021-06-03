@extends('layouts.app')
@section('title', '平台管理')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        @if ($platform->id)
            编辑平台
        @else
            添加平台
        @endif
    </div>
    <div class="layui-card-body">
        @if ($platform->id)
            <form class="layui-form p-t-15" action="{{ route('system.platforms.update', $platform->id) }}" method="POST">
                @method('PATCH')
        @else
            <form class="layui-form p-t-15" action="{{ route('system.platforms.store') }}" method="POST">
        @endif
                @csrf
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">平台名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="platform" lay-verify="required" autocomplete="off" class="layui-input" value="{{ old('platform', $platform->name) }}">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">负责人</label>
                    <div class="layui-input-inline">
                        <select name="user_id" lay-filter="user_id" required>
                            <option value="" hidden disabled {{ $platform->id ? '' : 'selected' }}>请选择分类</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $platform->user_id == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
layui.use(['form', 'table'], function () {
    var form = layui.form,
        table = layui.table;
    form.on('submit(go)', function (data) {

    })
})
</script>
@endsection
