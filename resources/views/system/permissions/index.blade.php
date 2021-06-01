@extends('layouts.app')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('system.permissions.create')
                    <button type="button" class="layui-btn layui-btn-sm" id="addBtn">添加</button>
                @endcan
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('system.permissions.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                    @can('system.permission.destroy')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        layui.config({
            base: '/layuiadmin/modules/'
        }).extend({
            treetable: 'treetable-lay/treetable'
        }).use(['layer', 'table', 'form', 'treetable'], function () {
            var $ = layui.$;
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            var treetable = layui.treetable;
            //用户表格初始化

            // 渲染表格
            var dataTable = function () {
                treetable.render({
                    treeColIndex: 1,          // treetable新增参数
                    treeSpid: 0,             // treetable新增参数
                    treeIdName: 'id',       // treetable新增参数
                    treePidName: 'parent_id',     // treetable新增参数
                    treeDefaultClose: true,   // treetable新增参数
                    treeLinkage: false,        // treetable新增参数
                    elem: '#dataTable',
                    url: "{{ route('system.permissions.index') }}",
                    cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'display_name', title: '显示名称',width:200}
                        , {field: 'name', title: '权限名称'}
                        , {field: 'created_at', title: '创建时间'}
                        , {field: 'updated_at', title: '更新时间'}
                        , {fixed: 'right',title:'操作', width: 260, align: 'center', toolbar: '#options'}
                    ]]
                });
            }
            dataTable(); //调用此函数可重新渲染表格

            //监听工具条
            table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    , layEvent = obj.event; //获得 lay-event 对应的值
                if (layEvent === 'del') {
                    deleteData(obj,"{{ route('system.permissions.destroy', 'permission_id') }}".replace(/permission_id/, data.id));
                } else if (layEvent === 'edit') {
                    layer.open({
                        type: 2,
                        title: "编辑",
                        shadeClose: true,
                        area: ["600px","400px"],
                        content: "/system/permission/"+data.id+"/edit",
                        end: function () {
                            dataTable();
                        }
                    })
                }
            });

            $("#addBtn").click(function () {
                layer.open({
                    type: 2,
                    title: "添加",
                    shadeClose: true,
                    area: ["600px","400px"],
                    content: "{{route("system.permissions.create")}}",
                    end: function () {
                        dataTable();
                    }
                })
            })
        })
    </script>

@endsection
