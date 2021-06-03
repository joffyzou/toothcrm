@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-header border-b-0 p-t-15" style="height: auto;">
        <div class="searchForm" style="margin-bottom: 15px;">
            <div class="layui-inline">
                <span>姓名：</span>
                <div class="layui-inline">
                    <input type="text" class="layui-input" name="name" id="nameSearch" autocomplete="off" placeholder="请输入姓名">
                </div>
                <button class="layui-btn" id="nameSearchBtn" data-type="reload">搜索</button>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">电话：</label>
                <div class="layui-inline">
                    <input class="layui-input" name="phone" id="phoneSearch" autocomplete="off" placeholder="请输入电话">
                </div>
                <button class="layui-btn" id="phoneSearchBtn" data-type="reload">搜索</button>
            </div>
        </div>
        <div class="layui-btn-container layui-clear" style="float: left;">
            <button class="layui-btn layui-btn-sm btn-date" value="default">全部</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="today">今天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="yesterday">昨天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="threeDay">最近三天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="sevenDay">最近一周</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="fifteenDay">最近15天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="thirtyDay">最近一个月</button>
        </div>
        <div class="layui-inline layui-form-item" style="margin-top: -16px; margin-bottom: 0;">
            <label class="layui-form-label">日期范围</label>
            <div class="layui-inline" id="dateSearch" style="margin: 0;">
                <div class="layui-input-inline">
                    <input type="text" name="startDate" id="startDate" class="layui-input" placeholder="开始日期">
                </div>
                <div class="layui-form-mid">-</div>
                <div class="layui-input-inline" style="margin: 0;">
                    <input type="text" name="endDate" id="endDate" class="layui-input" placeholder="结束日期">
                </div>
            </div>
            <button class="layui-btn" id="dateSearchBtn" data-type="reload">搜索</button>
        </div>
    </div>
    <div class="layui-card-body" style="padding-top: 0;">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-xs" lay-event="more">更多</a>
        </script>
    </div>
</div>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="repay">添加回访</a>
    <a class="layui-btn layui-btn-xs" lay-event="more">更多</a>
</script>
@endsection

@section('scripts')
<script>
layui.use(['table', 'laydate', 'form'], function () {
    var table = layui.table,
        laydate = layui.laydate,
        $ = layui.$,
        form = layui.form;

    var dataTable = table.render({
        elem: '#dataTable',
        url: "{{ route('crm.patients.index') }}",
        height: 'full-280',
        limit: 15,
        page: true,
        cols: [[
            {field: 'name', title: '姓名', align:'center', width: 75},
            {field: 'phone', title: '电话', align:'center', width: 120},
            {field: 'platform_id', title: '平台', align:'center', width: 90, templet: function (res) {
                    return res.platform.name;
                }},
            {field: 'is_add_wechat', title: '是否加微', align:'center', width: 92, templet: function (res) {
                    if (res.is_add_wechat === 1) {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="已加|未加" data-id="'+res.id+'" lay-filter="wechat-switch" checked />';
                    } else {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="已加|未加" data-id="'+res.id+'" lay-filter="wechat-switch" />';
                    }
                }},
            {field: 'project_id', align:'center', title: '咨询项目', width: 86, templet: function (res) {
                    return res.project.name;
                }},
            {field: 'is_to_store', title: '是否到店', align:'center', width: 92, templet: function (res) {
                    if (res.is_to_store === 1) {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="已到|未到" data-id="'+res.id+'" lay-filter="store-switch" checked />';
                    } else {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="已到|未到" data-id="'+res.id+'" lay-filter="store-switch" />';
                    }
                }},
            {field: 'achievement', title: '业绩', width: 86},
            {field: 'rema_time', title: '剩余时间', sort: true, width: 102, align: 'center'},
            {field: 'repay_time', title: '回访剩余', sort: true, width: 102, align: 'center'},
            {field: 'store_time', title: '到店剩余', sort: true, width: 102, align: 'center'},
            {field: 'note', title: '特殊备注'},
            {field: 'origin_id', title: '来源', width: 60, templet: function (res) {
                    return res.origin.name;
                }},
            {field: 'is_introduce_intention', title: '转介绍意向?', align: 'center', width: 110, templet: function (res) {
                    if (res.is_introduce_intention === 1) {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="有|没有" data-id="'+res.id+'" lay-filter="intention-switch" checked />';
                    } else {
                        return '<input type="checkbox" name="switch" lay-skin="switch" lay-text="有|没有" data-id="'+res.id+'" lay-filter="intention-switch" />';
                    }
                }},
            {field: 'introducer', title: '介绍人', width: 86},
            {field: 'appointment_time', title: '预约时间', sort: true, align:'center', width: 160},
            {fixed: 'right', title:'操作', align:'center', toolbar: '#barDemo', width:140}
        ]]
    });

    form.on('switch(wechat-switch)', function (data) {
        var wechat = data.elem.checked ? 1 : 0,
            load = layer.load();
        $.post('{{route('crm.patients.update', 'patient_id')}}'.replace(/patient_id/, $(data.elem).data('id')),
            {wechat: wechat, patient_id: $(data.elem).data('id'), _method: 'PUT'},
            function (res) {
                layer.close(load);
                layer.msg(res.msg, {icon: res.code == 0 ? 1 : 2})
            })
    });

    form.on('switch(store-switch)', function (data) {
        var store = data.elem.checked ? 1 : 0,
            load = layer.load();
        $.post('{{route('crm.patients.update', 'patient_id')}}'.replace(/patient_id/, $(data.elem).data('id')),
            {store: store, patient_id: $(data.elem).data('id'), _method: 'PUT'},
            function (res) {
                layer.close(load);
                layer.msg(res.msg, {icon: res.code == 0 ? 1 : 2})
            })
    });

    form.on('switch(intention-switch)', function (data) {
        var intention = data.elem.checked ? 1 : 0,
            load = layer.load();
        $.post('{{route('crm.patients.update', 'patient_id')}}'.replace(/patient_id/, $(data.elem).data('id')),
            {intention: intention, patient_id: $(data.elem).data('id'), _method: 'PUT'},
            function (res) {
                layer.close(load);
                layer.msg(res.msg, {icon: res.code == 0 ? 1 : 2})
            })
    });

    $('#nameSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.patients.index') }}",
            where: {
                name: $('#nameSearch').val()
            }
        })
    });

    $('#phoneSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.patients.index') }}",
            where: {
                phone: $('#phoneSearch').val()
            }
        })
    });

    laydate.render({
        elem: '#dateSearch',
        type: 'datetime',
        range: ['#startDate', '#endDate']
    });

    $('#dateSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.patients.index') }}",
            where: {
                startDate: $('#startDate').val(),
                endDate: $('#endDate').val()
            }
        })
    });

    $('.btn-date').each(function (i, e) {
        $(e).on('click', function () {
            $(this).removeClass('layui-btn-primary');
            $(this).siblings().addClass('layui-btn-primary');
            table.reload('dataTable', {
                url: "{{ route('crm.patients.index') }}",
                where: {
                    date : $(e).val()
                }
            });
        })
    });
});
</script>
@endsection





