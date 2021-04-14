@extends('layouts.app')

@section('content')
<div class="demoTable" style="margin-top: 15px;">
    搜索ID：
    <div class="layui-inline">
        <input class="layui-input" name="id" id="demoReload" autocomplete="off">
    </div>
    <button class="layui-btn" data-type="reload">搜索</button>
</div>
<table class="layui-table" lay-filter="demo">
    <thead>
        <tr>
            <th lay-data="{field:'name', width:80, sort:true}">姓名</th>
            <th lay-data="{field:'phone', width:120}">电话</th>
            <th lay-data="{field:'pid'}">平台</th>
            <th lay-data="{field:'is_appointment'}">是否预约</th>
            <th lay-data="{field:'is_add_wechat'}">是否加微</th>
            <th lay-data="{field:'project'}">咨询项目</th>
            <th lay-data="{field:'is_to_store'}">是否到店</th>
            <th lay-data="{field:'achievement'}">业绩</th>
            <th lay-data="{field:'achievement'}">剩余时间</th>
            <th lay-data="{field:'created_at'}">回访时间</th>
            <th lay-data="{field:'is_appointment'}">到店剩余</th>
            <th lay-data="{field:'note'}">特殊备注</th>
            <th lay-data="{field:'is_add_wechat'}">来源</th>
            <th lay-data="{field:'achievement'}">转介绍</th>
            <th lay-data="{field:'achievement'}">介绍人</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->phone }}</td>
                <td>大众</td>
                <td>{{ $patient->aid }}</td>
                <td>{{ $patient->is_appointment }}</td>
                <td>{{ $patient->is_add_wechat }}</td>
                <td>{{ $patient->project }}</td>
                <td>{{ $patient->is_to_store }}</td>
                <td>{{ $patient->achievement }}</td>
                <td>{{ $patient->created_at->diffForHumans() }}</td>
                <td>{{ $patient->is_appointment }}</td>
                <td>{{ $patient->is_add_wechat }}</td>
                <td>{{ $patient->project }}</td>
                <td>{{ $patient->is_to_store }}</td>
                <td>{{ $patient->achievement }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
