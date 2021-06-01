@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <form action="{{ route('system.roles.store') }}" method="POST" class="layui-form">
            @include('system.roles._form')
        </form>
    </div>
</div>
@endsection
