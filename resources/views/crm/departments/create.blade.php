@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <form action="{{ route('crm.departments.store') }}" method="post" class="layui-form">
            @include('crm.departments._form')
        </form>
    </div>
</div>
@endsection
