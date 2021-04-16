@extends('layouts.app')

@section('content')
<table id="demo" lay-filter="test"></table>
@endsection

@section('scripts')
<script>
layui.use('table', function(){
    var table = layui.table;

    table.render({
        elem: '#demo',
        url: "{{ route('patients.getAllPatients') }}",
        page: {
            layout: ['count', 'prev', 'page', 'next', 'skip'],
            groups: 1,
            first: false,
            last: false,
        },
        limit: 19,
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
            {fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
        ]],
        parseData: function(res){ //将原始数据解析成 table 组件所规定的数据
            return {
                "code": res.code, //解析接口状态
                "count": res.data.total, //解析数据长度
                "data": res.data.data //解析数据列表
            }
        },
        request: {
            pageName: 'page' //页码的参数名称，默认：page
            ,limitName: 'per_page' //每页数据量的参数名，默认：limit
        }
    });

});
</script>

<script type="text/html" id="barDemo">
    <a href="/patients/@{{d.id}}/edit" class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endsection
