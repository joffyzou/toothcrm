@extends('layouts.app')

@section('content')
<table class="layui-table">
    <thead>
        <tr>
            <th>姓名</th>
            <th>电话</th>
            <th>平台</th>
            <th>是否预约</th>
            <th>是否加微</th>
            <th>咨询项目</th>
            <th>是否到店</th>
            <th>业绩</th>
            <th>剩余时间</th>
            <th>回访时间</th>
            <th>到店剩余</th>
            <th>特殊备注</th>
            <th>来源</th>
            <th>转介绍</th>
            <th>介绍人</th>
            <th>是否有转介绍意向</th>
            <th>预约时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->pid }}</td>
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
                <td>是否有转介绍意向</td>
                <td>预约时间</td>
                <td><a href="#">编辑</a>/<a href="#">添加回访</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
