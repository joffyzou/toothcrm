@extends('layouts.app')

@section('content')

<div class="layui-form">
    <div class="layui-form-item" style="margin-bottom: 0;">
        <div class="layui-inline" style="margin-bottom: 0;">
            <label class="layui-form-label">时间范围:</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss">
            </div>
        </div>
    </div>
</div>
{{-- <div class="demoTable">
    <div class="layui-inline">
      <input class="layui-input" name="id" id="demoReload" autocomplete="off" placeholder="请输入电话">
    </div>
    <button class="layui-btn" data-type="reload">搜索</button>
</div> --}}

<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="getCheckData">今天</button>
        <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">昨天</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">最近三天</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">最近一周</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">最近15天</button>
        <button class="layui-btn layui-btn-sm" lay-event="isAll">最近一个月</button>
    </div>
</script>

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
}).use(['index', 'table', 'admin', 'laydate'], function(){
    var table = layui.table, $ = layui.$, admin = layui.admin, form = layui.form, laydate = layui.laydate;
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    table.render({
        elem: '#LAY_table_user',
        url: "{{ route('admins.patients', Auth::user()) }}",
        toolbar: '#toolbarDemo',
        defaultToolbar: false,
        method: 'post',
        headers: {'X-CSRF-TOKEN': csrf_token},
        cols: [[
            {field: 'id', title: 'ID', sort: true, fixed: 'left'},
            {field: 'name', title: '姓名'},
            {field: 'phone', title: '电话'},
            {field: 'platform', title: '平台'},
            {field: 'is_appointment', title: '是否预约'},
            {field: 'is_add_wechat', title: '是否加微'},
            {field: 'project', title: '咨询项目'},
            {field: 'is_to_store', title: '是否到店'},
            {field: 'achievement', title: '业绩'},
            {field: 'rema_time', title: '剩余时间'},
            {field: 'repay_time', title: '回访剩余'},
            {field: 'store_time', title: '到店剩余'},
            {field: 'note', title: '特殊备注'},
            {field: 'achievement', title: '来源'},
            {field: 'appointment_time', title: '预约时间'},
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

    laydate.render({
        elem: '#test5',
        type: 'datetime',
        range: true
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
            var html = '<div style="margin:15px;" class="layui-form-item"><div class="layui-input-inline">'+ obj.data.id +'<input type="text" name="repay" lay-verify="required" placeholder="请输入回访内容..." class="layui-input"></div></div>';
            layer.open({
                type: 2,
                title: '添加回访',
                offset: 'auto',
                area: ['450px', '400px'],
                content: '/patients/'+ obj.data.id,
                btn: ['确定', '取消'],
                btnAlign: 'c',
                shade: 0,
                yes: function (index, layero) {
                    var iframeWindow = window['layui-layer-iframe' + index],
                        submit = layero.find('iframe').contents().find("#layuiadmin-app-form-add");
                    iframeWindow.layui.form.on('submit(layuiadmin-app-form-add)', function (data) {
                        var field = data.field;
                        admin.req({
                            url: '/repays',
                            data: field,
                            method: 'POST',
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
                                            , username: field.username
                                            , role_names: field.role_names
                                            , tel: field.tel
                                            , sex: field.sex
                                            , status: field.status
                                        });
                                        table.reload('LAY-app-list');
                                        layer.close(index); //关闭弹层
                                    });
                                } else {
                                    layer.msg(res.msg, {icon: 2});
                                }
                            },
                        });
                    });
                    submit.trigger('click');
                }
            })
        }
    });
});
</script>
@endsection
