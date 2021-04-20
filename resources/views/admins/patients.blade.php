@extends('layouts.app')

@section('content')
<div class="demoTable">
    <div class="layui-inline">
      <input class="layui-input" name="id" id="demoReload" autocomplete="off" placeholder="请输入电话">
    </div>
    <button class="layui-btn" data-type="reload">搜索</button>
</div>

<table class="layui-hide" id="LAY_table_user" lay-filter="patients"></table>
@endsection
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs" lay-event="repay">添加回访</a>
</script>

@section('scripts')
<script>
layui.config({
    base: "/static/layuiadmin/"
}).extend({
    index: 'lib/index'
}).use(['index', 'table', 'admin'], function(){
    var table = layui.table, $ = layui.$, admin = layui.admin, form = layui.form;
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    table.render({
        elem: '#LAY_table_user',
        url: "{{ route('admins.patients', Auth::user()) }}",
        method: 'post',
        headers: {'X-CSRF-TOKEN': csrf_token},
        cols: [[
            {field: 'id', title: 'ID', sort: true, fixed: 'left'},
            {field: 'name', title: '姓名'},
            {field: 'phone', title: '电话'},
            {field: 'platform', title: '平台'},
            {field: 'is_appointment', title: '是否预约'},
            {field: 'appointment_time', title: '预约时间'},
            {field: 'is_add_wechat', title: '是否加微'},
            {field: 'project', title: '咨询项目'},
            {field: 'is_to_store', title: '是否到店'},
            {field: 'achievement', title: '业绩'},
            {field: 'note', title: '特殊备注'},
            {title:'操作', align:'center', toolbar: '#barDemo', width:150}
        ]],
        page: {
            layout: ['count', 'prev', 'page', 'next', 'skip'],
            groups: 1,
            first: false,
            last: false,
        },
        limit: 10,
        id: 'testReload'
    });

    var active = {
        reload: function () {
            var demoReload = $('#demoReload');
            table.reload('testReload', {
                page: {
                    curr: 1
                },
                where: {
                    key: {
                        id: demoReload.val()
                    }
                }
            });
        }
    };

    $('.demoTable .layui-btn').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });

    table.on('tool(patients)', function(obj){
        var data = obj.data.repay;
        if(obj.event === 'repay'){
            var html = '<div style="margin:15px;" class="layui-form-item"><div class="layui-input-inline"><input type="text" name="repay" lay-verify="required" placeholder="请输入回访内容..." class="layui-input"></div></div>';
            html += '<ul class="layui-timeline">';
                @foreach ($repays[16] as $key => $val)
            html += '<li class="layui-timeline-item">';
            html += '<i class="layui-icon layui-timeline-axis">&#xe63f;</i>';
            html += '<div class="layui-timeline-content layui-text">';
            html += '<h3 class="layui-timeline-title">' + "{{ $val['created_at'] }}";
            html += '</h3>';
            html += '<p>'+ "{{ $val['repay'] }}";
            html += '</p></div></li>';
            @endforeach;
            html += '</ul>';
            layer.open({
                type: 1,
                title: '添加回访',
                offset: 'auto',
                content: html,
                btn: ['确定', '取消'],
                btnAlign: 'c',
                shade: 0,
                yes: function (index, layero) {
                    var repay = $("input[name='repay']").val();
                    if (repay == '') {
                        layer.msg('回访内容不能为空', {icon:2});
                        return false;
                    }
                    var field = {
                        admin_id: {{ Auth::user()->id }},
                        patient_id: obj.data.id,
                        repay: repay
                    };
                    admin.req({
                        // url: '/patients/' + obj.data.id,
                        url: '/repays',
                        data: field,
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        },
                        beforeSend: function (XMLHttpRequest) {
                            layer.load();
                        },
                        done: function (res) {
                            layer.closeAll('loading');
                            if (res.code === 0) {
                                layer.msg(res.msg, {
                                    offset: '15px'
                                    , icon: 1
                                    , time: 1000
                                }, function () {
                                    obj.update({
                                        account: field.account
                                    });
                                    layer.close(index);
                                });
                            } else {
                                layer.msg(res.msg, {icon: 2});
                            }
                        }
                    });
                }
            })
        }
    });
});
</script>
@endsection
