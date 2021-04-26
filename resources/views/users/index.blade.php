@extends('layouts.app')

@section('content')
<a href="{{ route('admin.users.create') }}" class="layui-btn layui-btn-primary">
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
        <th>操作</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->role->name }}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td></td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection

@section('script')
<script>

</script>
@endsection
