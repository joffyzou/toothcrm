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

        <div class="layui-form" style="margin-bottom: 15px;">
            指派给：
            <div class="layui-inline">
                @csrf
                <select id="users" lay-filter="users">
                    <option value="">请选择客服</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <button class="layui-btn" id="allotBtn">确定</button>
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
        height: 'full-335',
        url: "{{ route('crm.seas.index') }}",
        limit: 14,
        page: true,
        cols: [[
            {type: 'checkbox'},
            {field: 'name', title: '姓名', width: 75},
            {field: 'phone', title: '电话', width: 120},
            {field: 'is_appointment', title: '是否预约', width: 86, unresize: true, align:'center', templet: function (res) {
                    if (res.is_appointment) {
                        return '<span class="layui-badge layui-bg-green">是</span>';
                    } else {
                        return '<span class="layui-badge layui-bg-gray">否</span>';
                    }
                }},
            {field: 'platform_id', title: '平台', align:'center', width: 120, templet: function (res) {
                    return res.platform.name;
                }},
            {field: 'is_add_wechat', title: '是否加微', width: 86, unresize: true, align:'center', templet: function (res) {
                    if (res.is_add_wechat) {
                        return '<span class="layui-badge layui-bg-green">是</span>';
                    } else {
                        return '<span class="layui-badge layui-bg-gray">否</span>';
                    }
                }},
            {field: 'project_id', align:'center', title: '咨询项目', width: 86, templet: function (res) {
                    return res.project.name;
                }},
            {field: 'is_to_store', title: '是否到店', width: 86, unresize: true, align:'center', templet: function (res) {
                    if (res.is_to_store) {
                        return '<span class="layui-badge layui-bg-green">是</span>';
                    } else {
                        return '<span class="layui-badge layui-bg-gray">否</span>';
                    }
                }},
            {field: 'note', title: '特殊备注'},
            {field: 'origin_id', title: '来源', width: 60, templet: function (res) {
                    return res.origin.name;
                }},
            {field: 'updated_at', title: '流入时间', width: 180},
            {title:'操作', align:'center', toolbar: '#barDemo', width:140}
        ]]
    });

    $('#nameSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.seas.index') }}",
            where: {
                name: $('#nameSearch').val()
            }
        })
    })

    $('#phoneSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.seas.index') }}",
            where: {
                phone: $('#phoneSearch').val()
            }
        })
    })

    laydate.render({
        elem: '#dateSearch',
        type: 'datetime',
        range: ['#startDate', '#endDate']
    });

    $('#dateSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.seas.index') }}",
            where: {
                startDate: $('#startDate').val(),
                endDate: $('#endDate').val()
            }
        })
    })

    $('.btn-date').each(function (i, e) {
        $(e).on('click', function () {
            $(this).removeClass('layui-btn-primary');
            $(this).siblings().addClass('layui-btn-primary');
            table.reload('dataTable', {
                url: "{{ route('crm.seas.index') }}",
                where: {
                    date : $(e).val()
                }
            });
        })
    });

    $('#allotBtn').on('click', function () {
        var checkStatus = table.checkStatus('dataTable'),
            data = checkStatus.data,
            ids = new Array(),
            selectval = $('#users').val();
        if (selectval && data.length > 0) {
            for (i=0; i<data.length; i++) {
                ids[i] = data[i].id;
            }
            $.ajax({
                url: "{{ route('crm.patients.updates') }}",
                data: {
                    id: JSON.stringify(ids),
                    zid: $('#users').val()
                },
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function (XMLHttpRequest) {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            table.reload('testReload');
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        } else if (data.length < 1) {
            layer.alert('请至少勾选一位患者！');
        } else {
            layer.alert('请选择一位客服！');
        }
    })
});
</script>
@endsection
