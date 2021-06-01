@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <form action="{{ route('system.roles.update', $role->id) }}" method="POST" class="layui-form">
            @csrf
            @method('PUT')
            @include('system.roles._form', ['role_id' => $role->id])
        </form>
    </div>
</div>
@endsection
