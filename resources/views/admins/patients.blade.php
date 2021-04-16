@extends('layouts.app')

@section('content')
<div class="demoTable">
    搜索电话号码：
    <div class="layui-inline">
        <input class="layui-input" name="phone" id="demoReload" autocomplete="off">
    </div>
    <div class="layui-btn" data-type="reload">搜索</div>
</div>
<table class="layui-hide" id="LAY_table_user" lay-filter="user" lay-data="{id: 'idTest'}"></table>
@endsection

@section('scripts')
<script>
layui.use('table', function(){
    var table = layui.table;
    table.render({
        elem: '#LAY_table_user',
        height: 666,
        url: "{{ route('admins.patientsdata', Auth::user()) }}",
        page: {
            layout: ['count', 'prev', 'page', 'next', 'skip'],
            groups: 1,
            first: false,
            last: false,
        },
        limit: 18,
        cols: [[
            {field: 'name', title: '姓名'},
            {field: 'phone', title: '电话'},
            {field: 'platform', title: '平台'},
            {field: 'is_appointment', title: '是否预约'},
            {field: 'is_add_wechat', title: '是否加微'},
            {field: 'project', title: '咨询项目'},
            {field: 'is_to_store', title: '是否到店'},
            {field: 'achievement', title: '业绩'},
            {field: 'note', title: '特殊备注'},
            {fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
        ]],
        parseData: function(res){
            return {
                "code": res.code,
                "count": res.data.total,
                "data": res.data.data
            }
        },
        id: 'testReload'
    });

    var $ = layui.$, active = {
        reload: function(){
            var demoReload = $('#demoReload');
            table.reload('testReload', {
                parseData: function(res) {
                    return {
                        'code': res.code,
                        'data': res.data
                    }
                },
                page: {
                    curr: 1
                },
                where: {
                    key: {
                        phone: demoReload.val()
                    }
                }
            });
        }
    };

    $('.demoTable .layui-btn').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });

});
</script>

<script type="text/html" id="barDemo">
    <a href="/patients/@{{d.id}}/edit" class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">添加回访</a>
</script>
@endsection
