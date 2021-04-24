@extends('layouts.iframe')

@section('content')
<div class="layui-form" style="padding: 20px 70px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" autocomplete="off" class="layui-input" value="{{ $patient->name }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">电话</label>
        <div class="layui-input-inline">
            <input type="tel" name="phone" autocomplete="off" class="layui-input" value="{{ $patient->phone }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">平台</label>
        <div class="layui-input-inline">
            <select name="platform" lay-filter="platform">
                @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}" @if ($platform->id == $patient->platform) selected @endif>{{ $platform->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">咨询项目</label>
        <div class="layui-input-inline">
            <select name="project" lay-filter="project">
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" @if ($project->id == $patient->project) selected @endif>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">业绩</label>
        <div class="layui-input-inline">
            <input type="text" name="achievement" autocomplete="off" class="layui-input" value="{{ $patient->achievement }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">预约时间</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="appointment_time" id="appointment_time" placeholder="yyyy-MM-dd HH:mm:ss" value="{{ $patient->appointment_time }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">来源</label>
        <div class="layui-input-inline">
            <select name="origin" lay-filter="origin">
                @foreach ($origins as $origin)
                <option value="{{ $origin->id }}" @if ($origin->id == $patient->origin) selected @endif>{{ $origin->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="patient_edit" id="patient_edit" value="确认修改">
    </div>
</div>

@endsection

@section('scripts')
<script>
layui.use('laydate', function(){
    var laydate = layui.laydate;
    laydate.render({
        elem: '#appointment_time',
        type: 'datetime',
        min: 0,
        max: 30
    });
})
</script>
@endsection
