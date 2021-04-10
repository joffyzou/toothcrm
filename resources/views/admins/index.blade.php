@extends('layouts.iframe')

@section('iframe-content')
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5">
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                    <button class="layui-btn" onclick="xadmin.open('添加用户','{{ route('admins.create') }}',452,286)"><i class="layui-icon"></i>添加</button>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                    <thead>
                        <tr>
                        <th>
                            <input type="checkbox" name=""  lay-skin="primary">
                        </th>
                        <th>ID</th>
                        <th>登录名</th>
                        <th>岗位</th>
                        <th>密码</th>
                        <th>创建时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                            <td>
                                <input type="checkbox" name=""  lay-skin="primary">
                            </td>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->role->name }}</td>
                            <td>{{ $admin->password }}</td>
                            <td>{{ $admin->created_at->diffForHumans() }}</td>
                            <td class="td-status">
                                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                            <td class="td-manage">
                                <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                                <i class="layui-icon">&#xe601;</i>
                                </a>
                                <a title="编辑"  onclick="xadmin.open('编辑','admin-edit.html')" href="javascript:;">
                                <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                                <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div>
                        <a class="prev" href="">&lt;&lt;</a>
                        <a class="num" href="">1</a>
                        <span class="current">2</span>
                        <a class="num" href="">3</a>
                        <a class="num" href="">489</a>
                        <a class="next" href="">&gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    layui.use(['laydate','form'], function(){
      var laydate = layui.laydate;
      var form = layui.form;

      //执行一个laydate实例
      laydate.render({
        elem: '#start' //指定元素
      });

      //执行一个laydate实例
      laydate.render({
        elem: '#end' //指定元素
      });
    });

     /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

              //发异步把用户状态进行更改
              $(obj).attr('title','停用')
              $(obj).find('i').html('&#xe62f;');

              $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
              layer.msg('已停用!',{icon: 5,time:1000});

            }else{
              $(obj).attr('title','启用')
              $(obj).find('i').html('&#xe601;');

              $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
              layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }



    function delAll (argument) {

      var data = tableCheck.getData();

      layer.confirm('确认要删除吗？'+data,function(index){
          //捉到所有被选中的，发异步进行删除
          layer.msg('删除成功', {icon: 1});
          $(".layui-form-checked").not('.header').parents('tr').remove();
      });
    }
  </script>
@endsection
