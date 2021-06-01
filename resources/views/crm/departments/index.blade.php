@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        <div class="layui-btn-group">
            @can('crm.departments.create')
                <a href="{{ route('crm.departments.create') }}" class="layui-btn layui-btn-sm">添加</a>
            @endcan
        </div>
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('crm.departments.edit')
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('crm.departments.destroy')
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
        form = layui.form,
        table = layui.table;

    var dataTable = function () {
        table.render({
            elem: '#dataTable',
            url: "{{ route('crm.departments.index') }}",
            cols: [[ //表头
                {field: 'id', title: 'ID', sort: true, width: 80},
                {field: 'name', title: '名称'},
                {field: 'user_name', title: '部门经理'},
                {field: 'created_at', title: '创建时间'},
                {field: 'updated_at', title: '更新时间'},
                {fixed: 'right',title:'操作', width: 260, align: 'center', toolbar: '#options'}
            ]]
        });
    }
    dataTable(); //调用此函数可重新渲染表格

    table.on('tool(dataTable)', function (obj) {
        var data = obj.data,
            layEvent = obj.event;
        if (layEvent === 'del') {
            deleteData(obj, '{{ route('crm.departments.destroy', 'department_id') }}'.replace(/department_id/, data.id));
        } else if (layEvent === 'edit') {
            window.location.href = '{{ route('crm.departments.edit', 'department_id') }}'.replace(/department_id/, data.id);
        }
    })
})
</script>
@endsection
