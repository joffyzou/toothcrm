@extends('layouts.app')

@section('content')
<div class="layui-form-item demoTable layui-form">
    搜索：
    <div class="layui-inline">
        <input class="layui-input" name="key" id="demoReload" autocomplete="off" placeholder="请输入姓名/电话">
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">时间范围</label>
        <div class="layui-input-inline">
            <input type="text" id="test5" name="dateBetween" placeholder="开始 ~ 结束" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-inline">
        <button class="layui-btn" data-type="reload" lay-submit lay-filter="LAY-app-search">搜索</button>
    </div>
</div>
<script type="text/html" id="toolbarTime">
    <div class="layui-btn-container">
        <input type="hidden" value="" id="created">
        <button class="layui-btn layui-btn-sm" lay-event="today">今天</button>
        <button class="layui-btn layui-btn-sm" lay-event="yesterday">昨天</button>
        <button class="layui-btn layui-btn-sm" lay-event="threeDay">最近三天</button>
        <button class="layui-btn layui-btn-sm" lay-event="sevenDay">最近一周</button>
        <button class="layui-btn layui-btn-sm" lay-event="fifteenDay">最近15天</button>
        <button class="layui-btn layui-btn-sm" lay-event="thirtyDay">最近一个月</button>
    </div>
</script>
<table class="layui-hide" id="admin_patients_table" lay-filter="admin_patients_table"></table>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs" lay-event="repay">添加回访</a>
</script>
@endsection

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
        elem: '#admin_patients_table',
        url: "{{ route('admins.patients', Auth::user()) }}",
        toolbar: '#toolbarTime',
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
        page: true,
        limit: 10,
        id: 'testReload'
    });

    laydate.render({
        elem: '#test5',
        range: '~'
    });

    form.on('submit(LAY-app-search)', function (data) {
        var field = data.field;
        table.reload('testReload', {
            url: "{{ route('admins.patients', Auth::user()) }}" + '?form=form',
            where: field
        });
    });

    table.on('toolbar(admin_patients_table)', function (obj) {
        $('#created').val(obj.event);
        var created = $('#created').val();
        table.reload('testReload', {
            url: "{{ route('admins.patients', Auth::user()) }}" + '?created=' + created,
        })
    });

    table.on('tool(admin_patients_table)', function(obj){
        if(obj.event === 'repay'){
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
