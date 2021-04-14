@extends('layouts.app')

@section('content')
<a href="{{ route('admins.create') }}" class="layui-btn layui-btn-primary">
    <i class="layui-icon">&#xe654;</i> 添加员工
</a>
<table class="layui-table">
<thead>
    <tr>
        <th>ID</th>
        <th>登录名</th>
        <th>岗位</th>
        <th>密码</th>
        <th>创建时间</th>
    </tr>
</thead>
<tbody>
    @foreach ($admins as $admin)
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->username }}</td>
            <td>{{ $admin->role->name }}</td>
            <td>{{ $admin->password }}</td>
            <td>{{ $admin->created_at->diffForHumans() }}</td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection
