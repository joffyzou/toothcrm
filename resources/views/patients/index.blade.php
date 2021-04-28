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
                <input type="text" id="test5" name="dateBetween" placeholder="过去 ~ 现在" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <button class="layui-btn" data-type="reload" lay-submit lay-filter="LAY-app-search">搜索</button>
        </div>
    </div>

    <div class="layui-form-item layui-form">
        指派给：
        <div class="layui-inline">
            <select id="users" lay-filter="users">
                <option value="">请选择客服</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
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
{{--        <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="repay">添加回访</a>--}}
        <a class="layui-btn layui-btn-xs" lay-event="more">更多</a>
    </script>
@endsection

@section('scripts')
    <script>
        layui.config({
            base: "/static/layuiadmin/"
        }).extend({
            index: 'lib/index'
        }).use(['index', 'table', 'admin', 'laydate', 'dropdown'], function(){
            var table = layui.table,
                $ = layui.$,
                admin = layui.admin,
                form = layui.form,
                laydate = layui.laydate,
                dropdown = layui.dropdown;
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            table.render({
                elem: '#admin_patients_table',
                url: "{{ route('admin.patients.index') }}",
                toolbar: '#toolbarTime',
                defaultToolbar: false,
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': csrf_token},
                cols: [[
                    {type: 'checkbox'},
                    {field:'id', title:'ID', width:80, unresize: true, sort: true},
                    {field: 'name', title: '姓名', width: 75},
                    {field: 'phone', title: '电话', width: 120},
                    {field: 'is_appointment', title: '是否预约', width: 86, templet: '#switchAppointment', unresize: true, align:'center'},
                    {field: 'platform', title: '平台', align:'center', width: 80},
                    {field: 'is_add_wechat', title: '是否加微', width: 86, templet: '#switchWechat', unresize: true, align:'center'},
                    {field: 'project', align:'center', title: '咨询项目', width: 86},
                    {field: 'is_to_store', title: '是否到店', width: 86, templet: '#switchStore', unresize: true, align:'center'},
                    {field: 'note', title: '特殊备注'},
                    {field: 'origin', title: '来源', width: 60},
                    {title:'操作', align:'center', toolbar: '#barDemo', width:140}
                ]],
                page: true,
                limit: 10,
                id: 'testReload'
            });

            // 是否预约
            form.on('switch(Appointment)', function(obj){
                var field = {
                    is_appointment: this.checked ? 1 : 0,
                    id: $(this).data('id')
                };
                admin.req({
                    url: '/admin/patients/' + $(this).data('id'),
                    data: field,
                    method: 'PUT',
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
                            });
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    }
                })
            });

            // 是否加微
            form.on('switch(addWechat)', function(obj){
                var field = {
                    is_add_wechat: this.checked ? 1 : 0,
                    id: $(this).data('id')
                };
                admin.req({
                    url: '/admin/patients/' + $(this).data('id'),
                    data: field,
                    method: 'PUT',
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
                            });
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    }
                })
            });

            // 是否到店
            form.on('switch(toStore)', function(obj){
                var field = {
                    is_to_store: this.checked ? 1 : 0,
                    id: $(this).data('id')
                };
                admin.req({
                    url: '/admin/patients/' + $(this).data('id'),
                    data: field,
                    method: 'PUT',
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
                            });
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    }
                })
            });

            laydate.render({
                elem: '#test5',
                range: '~'
            });

            form.on('submit(LAY-app-search)', function (data) {
                var field = data.field;
                table.reload('testReload', {
                    url: "{{ route('admin.users.patients', Auth::user()) }}" + '?form=form',
                    where: field
                });
            });

            table.on('toolbar(admin_patients_table)', function (obj) {
                $('#created').val(obj.event);
                var created = $('#created').val();
                table.reload('testReload', {
                    url: "{{ route('admin.patients.index') }}" + '?created=' + created,
                    method: 'PUT'
                })
            });

            table.on('tool(admin_patients_table)', function(obj){
                var data = obj.data, layEvent = obj.event;
                if(layEvent === 'more') {
                    dropdown.render({
                        elem: this,
                        show: true,
                        data: [{
                            title: '特殊备注',
                            id: 'addNote'
                        }, {
                            title: '编辑信息',
                            id: 'edit'
                        }],
                        click: function (menudata) {
                            if (menudata.id === 'addNote') {
                                console.log(data.id);
                                layer.prompt({
                                    title: '添加特殊备注',
                                    formType: 2,
                                    value: data.note,
                                    maxlength: 50
                                }, function (value, index) {
                                    var date = {
                                        note: value
                                    };
                                    admin.req({
                                        url: '/admin/patients/' + data.id,
                                        method: 'put',
                                        data: date,
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
                                                        note: value
                                                    });
                                                    table.reload('testReload');
                                                    layer.close(index);
                                                });
                                            } else {
                                                layer.msg(res.msg, {icon: 2});
                                            }
                                        }
                                    });
                                });
                            } else if (menudata.id === 'edit') {
                                layer.open({
                                    type: 2,
                                    title: '编辑',
                                    offset: 'auto',
                                    area: ['450px', '400px'],
                                    content: '/admin/patients/'+ obj.data.id + '/edit',
                                    btn: ['确定', '取消'],
                                    btnAlign: 'c',
                                    yes: function (index, layero) {
                                        var iframeWindow = window['layui-layer-iframe' + index],
                                            submit = layero.find('iframe').contents().find("#patient_edit");
                                        iframeWindow.layui.form.on('submit(patient_edit)', function (data) {
                                            var field = data.field;
                                            admin.req({
                                                url: '/admin/patients/' + obj.data.id,
                                                data: field,
                                                method: 'PUT',
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
                                                                name: field.name,
                                                                phone: field.phone,
                                                                platform: field.platform,
                                                                project: field.project,
                                                                achievement: field.achievement
                                                            });
                                                            table.reload('testReload');
                                                            layer.close(index); //关闭弹层
                                                        });
                                                    } else {
                                                        layer.msg(res.msg, {icon: 2});
                                                    }
                                                }
                                            });
                                        });
                                        submit.trigger('click');
                                    }
                                });
                            }
                        }
                        , style: 'margin-left: -42px;' //设置额外样式
                    })
                }
            });

            form.on('select(users)', function (obj) {
                var checkStatus = table.checkStatus('testReload'),
                    data = checkStatus.data,
                    ids = new Array(),
                    selectval = $('#users').val()
                if (selectval && data.length > 0) {
                    for (i=0; i<data.length; i++) {
                        ids[i] = data[i].id;
                    }
                    admin.req({
                        url: "{{ route('admin.patients.updates') }}",
                        data: {
                            id: JSON.stringify(ids),
                            zid: $('#users').val()
                        },
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
                                    table.reload('testReload');
                                });
                            } else {
                                layer.msg(res.msg, {icon: 2});
                            }
                        }
                    });
                } else if (data.length <= 1) {
                    layer.alert('请至少勾选一位患者！');
                } else {
                    layer.alert('请选择一位客服！');
                }
            })
        });
    </script>
@endsection





