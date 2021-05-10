@extends('layouts.app')

@section('content')
<form class="layui-form" action="{{ route('admin.patients.store') }}" method="POST">
    @csrf
    <div class="layui-form-item">
        <label class="layui-form-label">患者姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" required  lay-verify="required" value="{{ old('name') }}" placeholder="请输入患者姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否有效</label>
        <div class="layui-input-block">
            <input type="radio" name="state" lay-filter="state" value="1" title="是" checked>
            <input type="radio" name="state" lay-filter="state" value="0" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">患者电话</label>
        <div class="layui-input-inline">
            <input type="tel" name="phone" required  lay-verify="required|phone|number" value="{{ old('phone') }}" placeholder="请输入患者电话" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">咨询项目</label>
        <div class="layui-input-inline">
            <select name="project" lay-verify="required">
                <option value="">请选择咨询项目</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">平台</label>
        <div class="layui-input-inline">
            <select name="platform" lay-verify="required">
                <option value="">请选择平台</option>
                @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="layui-btn" id="addPlatform">添加新平台</a>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">来源</label>
        <div class="layui-input-inline">
            <select name="origin" lay-verify="required">
                <option value="">请选择来源</option>
                @foreach ($origins as $origin)
                    <option value="{{ $origin->id }}">{{ $origin->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">预约时间</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="appointment_time" id="appointment_time" placeholder="yyyy-MM-dd HH:mm:ss">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否加微</label>
        <div class="layui-input-block">
            <input type="radio" name="is_add_wechat" value="1" title="是">
            <input type="radio" name="is_add_wechat" value="0" title="否" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">业绩</label>
        <div class="layui-input-inline">
            <input type="text" name="achievement" placeholder="请输入业绩" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">指派客服</label>
        <div class="layui-input-inline">
            <select name="users">
                <option value="">请选择同事</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">特殊备注</label>
        <div class="layui-input-inline">
            <textarea name="note" placeholder="请输入内容" class="layui-textarea" cols="21">{{ old('note') }}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">录入</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
layui.config({
    base: "/static/layuiadmin/"
}).extend({
    index: 'lib/index'
}).use(['index', 'admin'], function(){
    var laydate = layui.laydate,
        form = layui.form,
        layer = layui.layer,
        $ = layui.$,
        admin = layui.admin;
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    laydate.render({
        elem: '#appointment_time',
        type: 'datetime',
        min: 0,
        max: 30
    });

    $('#addPlatform').on('click', function () {
        layer.prompt({
            title: '添加新平台',
            move: false
        }, function(val, index){
            admin.req({
                url: '/admin/platforms/',
                method: 'POST',
                data: {
                    platform: val
                },
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                beforeSend: function (XMLHttpRequest) {
                    layer.load();
                },
                done: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(index);
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            });
        });
    });

    form.on('submit(addPlatform)', function (data) {
        console.log(data);
    });

    form.on('radio(state)', function (data) {
        let time = '1' + Date.now().toString().substring(3);
        if (data.value === '0') {
            $('input[type=tel][name=phone]').val(time);
        } else {
            $('input[type=tel][name=phone]').val('');
        }
    });
});
</script>
@endsection
