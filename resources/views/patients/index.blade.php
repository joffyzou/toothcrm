@extends('layouts.app')

@section('content')
<table id="demo" lay-filter="test"></table>
@endsection

@section('scripts')
<script>
layui.use('table', function(){
    var table = layui.table;
    var $ = layui.$;
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    table.render({
        elem: '#demo',
        url: "{{ route('admin.patients.index') }}",
        method: 'post',
        headers: {'X-CSRF-TOKEN': csrf_token},
        cols: [[
            {field: 'name', title: '姓名', sort: true, fixed: 'left'},
            {field: 'phone', title: '电话'},
            {field: 'sex', title: '平台', sort: true},
            {field: 'city', title: '是否预约'},
            {field: 'sign', title: '是否加微'},
            {field: 'experience', title: '咨询项目', sort: true},
            {field: 'score', title: '是否到店', sort: true},
            {field: 'classify', title: '业绩'},
            {field: 'wealth', title: '财富', sort: true},
            {title:'操作', align:'center', toolbar: '#barDemo', width:150}
        ]],
        page: {
            layout: ['count', 'prev', 'page', 'next', 'skip'],
            groups: 1,
            first: false,
            last: false,
        },
        limit: 10,
    });

});
</script>

<script type="text/html" id="barDemo">
    <a href="/patients/@{{d.id}}/edit" class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endsection
