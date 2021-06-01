@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <form action="{{ route('crm.departments.update', $model->id) }}" method="POST" class="layui-form">
            @csrf
            @method('PUT')
            @include('crm.departments._form')
        </form>
    </div>
</div>
@endsection
