@extends('layouts.app')

@section('content')
<script type="text/html" id="toolbarTime">
    <a href="{{ route('admin.users.create') }}" class="layui-btn layui-btn-primary">
        <i class="layui-icon">&#xe654;</i> 添加员工
    </a>
</script>
@csrf
<table class="layui-hide" id="users_table" lay-filter="users_table"></table>
<script type="text/html" id="account-list">
    <a class="layui-btn layui-btn-xs layui-btn-primary layui-border-red" lay-event="account">
        <i class="layui-icon layui-icon-password"></i>账号密码
    </a>
</script>
@endsection

@section('scripts')
<script>
layui.use(['table'], function(){
    var $ = layui.$,
        table = layui.table;
    var csrf_token = $('input[name=_token]').val();

    table.render({
        elem: '#users_table',
        url: "{{ route('admin.users.index') }}",
        toolbar: '#toolbarTime',
        defaultToolbar: false,
        method: 'PUT',
        headers: {'X-CSRF-TOKEN': csrf_token},
        cols: [[
            {field: 'username', title: '登录名', align:'center'},
            {field: 'role_name', title: '岗位', align:'center'},
            {field: 'joinTime', title: '加入时间', align:'center'},
            {title:'操作', align:'center', toolbar: '#account-list'}
        ]],
        id: 'testReload',
        limit: 30
    });

    table.on('tool(users_table)', function(obj){
        var data = obj.data, layEvent = obj.event;
        if(layEvent === 'account'){
            var html = '<div style="margin-top: 5%" class="layui-form-item"> <label class="layui-form-label">登录账号：</label> <div class="layui-input-inline"> <input type="text" name="username" value="' + obj.data.username + '" lay-verify="required" placeholder="请输入账号" class="layui-input"> </div> </div> <div class="layui-form-item"><label class="layui-form-label">登录密码：</label> <div class="layui-input-inline"><input type="password" name="password" lay-verify="required"  class="layui-input"></div></div>';
            layer.open({
                type: 1
                , title: '账号密码'
                , offset: 'auto'
                , id: 'layerDemo'
                , content: html
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
        }
    })

})
</script>
@endsection
