@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        @can ('system.users.create')
            <a href="{{ route('system.users.create') }}" class="layui-btn layui-btn-sm"><i class="layui-icon">&#xe654;</i> 添加</a>
        @endcan
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('system.users.edit')
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('system.users.role')
                    <a class="layui-btn layui-btn-sm" lay-event="role">角色</a>
                @endcan
                @can('system.users.destroy')
                    <a class="layui-btn layui-btn-danger layui-btn-sm " lay-event="del">删除</a>
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
        table = layui.table,
        form = layui.form;

    var dataTable = table.render({
        elem: '#dataTable',
        height: 'full-218',
        url: '{{ route('system.users.index') }}',
        page: true,
        cols: [[
            {field: 'id', title: 'ID', sort: true, width: 80},
            {field: 'username', title: '帐号'},
            {field: 'department_id', title: '部门', templet: function (res) {
                    return res.department.name;
                }},
            {field: 'role', title: '角色', templet: function (res) {
                    var roles = [];
                    for (let i in res.roles) {
                         roles[i] = res.roles[i].display_name;
                    }
                    return roles;
                }},
            {field: 'status', title: '状态', align: 'center', templet: function (res) {
                    if (res.status == 1) {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="启用|禁用" data-userid="'+res.id+'" lay-filter="status-switch" checked />';
                    } else {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="启用|禁用" data-userid="'+res.id+'" lay-filter="status-switch" />';
                    }
                }},
            {field: 'created_at', title: '创建时间', width: 160},
            {fixed: 'right', title: '操作', align: 'center', toolbar: '#options'}
        ]]
    });

    form.on('switch(status-switch)', function (data) {
        var status = data.elem.checked ? 1 : 0;
        var load = layer.load();
        $.post('{{ route('system.users.status') }}', {status: status, user_id: $(data.elem).data("userid")}, function (res) {
            layer.close(load);
            layer.msg(res.msg, {icon: res.code == 0 ? 1 : 0});
        })
    })

    table.on('tool(dataTable)', function (obj) {
        var data = obj.data,
            layEvent = obj.event;
        if (layEvent === 'del') {
            deleteData(obj, '{{ route('system.users.destroy', 'user_id') }}'.replace(/user_id/, data.id));
        } else if (layEvent === 'edit') {
            window.location.href = '{{ route('system.users.edit', 'user_id') }}'.replace(/user_id/, data.id);
        }
    })
})
</script>
@endsection
