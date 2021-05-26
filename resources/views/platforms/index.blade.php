@extends('layouts.app')
@section('title', '平台管理')

@section('content')
<table id="dataTable" lay-filter="dataTable"></table>
@endsection

@section('scripts')
<script>
layui.use(['table'], function () {
    var table = layui.table,
        dataTable = table.render({
            elem: '#dataTable',
            url: '{{ route('admin.platforms.index') }}',
            page: true,
            cols: [[
                {field: 'id', title: 'ID', align:'center'},
                {field: 'name', title: '名称', align:'center'},
                {field: 'user_id', title: '负责人', align:'center'},
                {title:'操作', align:'center', toolbar: '#account-list'}
            ]]
        });

    table.on('tool(dataTable)', function (obj) {

    });
})
</script>
@endsection
