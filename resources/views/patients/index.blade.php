@extends('layouts.app')

@section('content')
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

        <div class="layui-inline layui-form-item" style="margin-bottom: 0;">
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

    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm btn-date" value="default">全部</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="today">今天</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="yesterday">昨天</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="threeDay">最近三天</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="sevenDay">最近一周</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="fifteenDay">最近15天</button>
        <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="thirtyDay">最近一个月</button>
    </div>

    <table class="layui-hide" id="admin_patients_table" lay-filter="admin_patients_table"></table>

    {{--是否预约--}}
    <script type="text/html" id="switchAppointment">
        <span class="layui-badge @{{ d.is_appointment ? 'layui-bg-green':'layui-bg-gray' }}">
            @{{ d.is_appointment ? '是':'否' }}
        </span>
    </script>

    {{--是否加微--}}
    <script type="text/html" id="switchWechat">
        <span class="layui-badge @{{ d.is_add_wechat ? 'layui-bg-green':'layui-bg-gray' }}">
            @{{ d.is_add_wechat ? '是':'否' }}
        </span>
    </script>

    {{--是否到店--}}
    <script type="text/html" id="switchStore">
        <span class="layui-badge @{{ d.is_to_store ? 'layui-bg-green':'layui-bg-gray' }}">
            @{{ d.is_to_store ? '是':'否' }}
        </span>
    </script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="more">更多</a>
    </script>
@endsection

@section('scripts')
<script>
layui.use(['table', 'laydate', 'form'], function () {
    var table = layui.table,
        laydate = layui.laydate,
        form = layui.form,
        $ = layui.$;

    table.render({
        elem: '#admin_patients_table',
        url: "{{ route('admin.cespatients.lists') }}",
        page: true,
        limit: 10,
        id: 'testReload',
        cols: [[
            {type: 'checkbox'},
            {field: 'name', title: '姓名', width: 75},
            {field: 'phone', title: '电话', width: 120},
            {field: 'is_appointment', title: '是否预约', width: 86, templet: '#switchAppointment', unresize: true, align:'center'},
            {field: 'platform_name', title: '平台', align:'center', width: 120},
            {field: 'is_add_wechat', title: '是否加微', width: 86, templet: '#switchWechat', unresize: true, align:'center'},
            {field: 'project_name', align:'center', title: '咨询项目', width: 86},
            {field: 'is_to_store', title: '是否到店', width: 86, templet: '#switchStore', unresize: true, align:'center'},
            {field: 'note', title: '特殊备注'},
            {field: 'origin_name', title: '来源', width: 60},
            {field: 'updated_at', title: '流入时间', width: 180},
            {title:'操作', align:'center', toolbar: '#barDemo', width:140}
        ]]
    });

    $('#nameSearchBtn').on('click', function () {
        table.reload('testReload', {
            url: "{{ route('admin.cespatients.lists') }}",
            where: {
                name: $('#nameSearch').val()
            }
        })
    })

    $('#phoneSearchBtn').on('click', function () {
        table.reload('testReload', {
            url: "{{ route('admin.cespatients.lists') }}",
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
        table.reload('testReload', {
            url: "{{ route('admin.cespatients.lists') }}",
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
            table.reload('testReload', {
                url: "{{ route('admin.cespatients.lists') }}",
                where: {
                    date : $(e).val()
                }
            });
        })
    });

    $('#allotBtn').on('click', function () {
        var checkStatus = table.checkStatus('testReload'),
            data = checkStatus.data,
            ids = new Array(),
            selectval = $('#users').val();
        if (selectval && data.length > 0) {
            for (i=0; i<data.length; i++) {
                ids[i] = data[i].id;
            }
            $.ajax({
                url: "{{ route('admin.patients.updates') }}",
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
        } else if (data.length <= 1) {
            layer.alert('请至少勾选一位患者！');
        } else {
            layer.alert('请选择一位客服！');
        }
    })
});
</script>
@endsection





