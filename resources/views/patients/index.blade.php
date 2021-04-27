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
        <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="repay">添加回访</a>
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
                defaultToolbar: [{
                    title: '指派',
                    layEvent: 'TABLE_ASSIGN',
                    icon: 'layui-icon-service'
                }],
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': csrf_token},
                cols: [[
                    {type: 'checkbox'},
                    {field: 'name', title: '姓名', width: 75},
                    {field: 'phone', title: '电话', width: 120},
                    {field: 'is_appointment', title: '是否预约', width: 86, templet: '#switchAppointment', unresize: true, align:'center'},
                    {field: 'platform', title: '平台', align:'center', width: 80},
                    {field: 'is_add_wechat', title: '是否加微', width: 86, templet: '#switchWechat', unresize: true, align:'center'},
                    {field: 'project', align:'center', title: '咨询项目', width: 86},
                    {field: 'is_to_store', title: '是否到店', width: 86, templet: '#switchStore', unresize: true, align:'center'},
                    {field: 'achievement', title: '业绩', width: 86},
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
                if (obj.event === 'TABLE_ASSIGN') {
                    //  var html = "<div class='layui-form'><select name='users' lay-filter='users'>@foreach ($users as $user)<option value=" + {{ $user->id }} + ">{{ $user->username }}</option>@endforeach</select></div>";
                    layer.open({
                        type: 1
                        , title: '指派给'
                        , offset: 'auto'
                        , id: 'layerDemo'
                        , content: $('#usersSelect')
                        , btn: ['确定', '取消']
                        , btnAlign: 'c'
                        , yes: function (index, layero) {
                            var password = $("input[name='password']").val();
                            var username = $("input[name='username']").val();
                            if (password == '') {
                                layer.msg('密码不能为空', {icon: 2});
                                return false;
                            }
                            if (username == '') {
                                layer.msg('账号不能为空', {icon: 2});
                                return false;
                            }
                            var field = {
                                id: obj.data.id,
                                password: password,
                                username: username
                            };
                            admin.req({
                                url: '/admin/users/' + obj.data.id
                                , data: field
                                , method: 'PUT'
                                , headers: {
                                    'X-CSRF-TOKEN': csrf_token
                                }
                                , beforeSend: function (XMLHttpRequest) {
                                    layer.load();
                                }
                                , done: function (res) {
                                    layer.closeAll('loading');
                                    if (res.code === 0) {
                                        layer.msg(res.msg, {
                                            offset: '15px'
                                            , icon: 1
                                            , time: 1000
                                        }, function () {
                                            obj.update({
                                                username: field.username
                                            }); //数据更新
                                            layer.close(index); //关闭弹层
                                        });
                                    } else {
                                        layer.msg(res.msg, {icon: 2});
                                    }
                                }
                            });
                        }
                        , btn2: function (index, layero) {
                            layer.closeAll();
                        }
                    });
                } else {
                    $('#created').val(obj.event);
                    var created = $('#created').val();;
                    table.reload('testReload', {
                        url: "{{ route('admin.patients.index') }}" + '?created=' + created,
                        method: 'PUT'
                    })
                }
            });

            table.on('tool(admin_patients_table)', function(obj){
                var data = obj.data, layEvent = obj.event;
                if(layEvent === 'repay'){
                    layer.open({
                        type: 2,
                        title: '添加回访',
                        offset: 'auto',
                        area: ['450px', '400px'],
                        content: '/admin/patients/'+ obj.data.id,
                        btn: ['确定', '取消'],
                        btnAlign: 'c',
                        yes: function (index, layero) {
                            var iframeWindow = window['layui-layer-iframe' + index],
                                submit = layero.find('iframe').contents().find("#layuiadmin-app-form-add");
                            iframeWindow.layui.form.on('submit(layuiadmin-app-form-add)', function (data) {
                                var field = data.field;
                                admin.req({
                                    url: '/admin/repays',
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
                                                table.reload('testReload');
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
                } else if(layEvent === 'more') {
                    //下拉菜单
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
        });
    </script>
@endsection


@section('bottom')
    <div class="layui-form" id="usersSelect">
        <label for="">指派给：</label>
        <div class="layui-input-inline">
            <select name="platform" lay-filter="platform">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection
