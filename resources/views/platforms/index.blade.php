@extends('layouts.app')
@section('title', '平台管理')

@section('content')
<div class="layui-card">
    <div class="layui-card-header border-b-0 p-t-15">
        <a class="layui-btn" href="{{ route('admin.platforms.create') }}"><i class="layui-icon">&#xe654;</i> 添加新平台</a>
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="dataTableBar">
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        </script>
    </div>
</div>
@endsection

@section('scripts')
<script>
layui.use(['table', 'layer'], function () {
    var table = layui.table,
        $ = layui.$,
        layer = layui.layer,
        dataTable = table.render({
            elem: '#dataTable',
            url: "{{ route('admin.platforms.index') }}",
            page: true,
            limit: 15,
            cols: [[
                {field: 'id', title: 'ID', align:'center', width: 80},
                {field: 'name', title: '名称', align:'center'},
                {field: 'user_id', title: '负责人', align:'center', templet: function (res) {
                        return res.user.username;
                    }},
                {field: 'right', title: '操作', align: 'center', toolbar: '#dataTableBar'}
            ]]
        });

    table.on('tool(dataTable)', function (obj) {
        if (obj.event === 'del') {
            deleteData(obj, "{{ route('admin.platforms.destroy', 'platform_id') }}".replace(/platform_id/, obj.data.id), 'dataTable');
        } else if (obj.event === 'edit') {
            window.location.href = "{{ route('admin.platforms.edit', 'platform_id') }}".replace(/platform_id/, obj.data.id);
        }
    });
})
</script>
@endsection
