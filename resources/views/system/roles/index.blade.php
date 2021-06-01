@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <div class="layui-btn-group">
            @can('system.roles.create')
                <a href="{{ route('system.roles.create') }}" class="layui-btn layui-btn-sm">添加</a>
            @endcan
        </div>
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('system.roles.edit')
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('system.roles.destroy')
                    <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                @endcan
            </div>
        </script>
    </div>
</div>
@endsection

@section('scripts')
<script>
layui.use(['layer', 'table', 'form'], function () {
    var $ = layui.$,
        layer = layui.layer,
        form = layui.form,
        table = layui.table;

    var dataTable = table.render({
        elem: '#dataTable',
        height: 'full-200',
        url: "{{ route('system.roles.index') }}",
        page: true,
        cols: [
            [
                {checkbox: true, fixed: true},
                {field: 'id', title: 'ID', sort: true, width: 80},
                {field: 'display_name', title: '显示名称'},
                {field: 'name', title: '名称'},
                {field: 'created_at', title: '创建时间'},
                {field: 'updated_at', title: '更新时间'},
                {fixed: 'right', title: '操作', width: 260, align: 'center', toolbar: '#options'}
            ]
        ]
    });

    table.on('tool(dataTable)', function (obj) {
        var data = obj.data,
            layEvent = obj.event;
        if (layEvent === 'del') {
            deleteData(obj, '{{ route('system.roles.destroy', 'role_id') }}'.replace(/role_id/, data.id));
        } else if (layEvent === 'edit') {
            window.location.href = '{{ route('system.roles.edit', 'role_id') }}'.replace(/role_id/, data.id);
        }
    })
})
</script>
@endsection
