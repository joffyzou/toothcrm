@extends('layouts.app')
@section('title', '平台展示')

@section('content')
    <div class="layui-card" style="margin-bottom: 50px;">
        <div class="layui-card-header p-t-15 border-b-0" style="height: auto;">
            <div style="margin-bottom: 15px;">
                <div class="layui-layout-right" style="padding-right: 20px; padding-top: 15px;">
                    @if (Request::input('platform_id'))
                        <span>责任人：</span>
                        <span>{{ $platform->user->username }}</span>
                    @endif
                </div>
                <div class="layui-form">
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <select name="platform" lay-verify="required" lay-filter="platforms" id="platform">
                                <option value="0">请选择平台</option>
                                @foreach ($platforms as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <fieldset class="layui-elem-field layui-inline" style="margin-right: 39px;">
                <legend>对话</legend>
                <div class="layui-field-box">
                    <div class="layui-form layui-form-pane">
                        <div class="layui-inline" style="width: 175px;" id="dhleftinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">对话数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" required lay-verify="required" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" required lay-verify="required" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="2" style="width: 95%; margin-left: 0;" id="dhleft">提交</button>
                            </div>
                        </div>
                        <div class="layui-inline" style="width: 175px;" id="dhrightinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="2" style="width: 95%; margin-left: 0;" id="dhright">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="layui-elem-field layui-inline" style="margin-right: 39px;">
                <legend>进电</legend>
                <div class="layui-field-box">
                    <div class="layui-form layui-form-pane">
                        <div class="layui-inline" style="width: 175px;" id="jdleftinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">进电数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="1" style="width: 95%; margin-left: 0;" id="jdleft">提交</button>
                            </div>
                        </div>
                        <div class="layui-inline" style="width: 175px;" id="jdrightinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="1" style="width: 95%; margin-left: 0;" id="jdright">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="layui-elem-field layui-inline" style="margin-right: 39px;">
                <legend>留咨</legend>
                <div class="layui-field-box">
                    <div class="layui-form layui-form-pane">
                        <div class="layui-inline" style="width: 175px;" id="lzleftinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">留咨数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="3" style="width: 95%; margin-left: 0;" id="lzleft">提交</button>
                            </div>
                        </div>
                        <div class="layui-inline" style="width: 175px;" id="lzrightinput">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="sum" class="layui-input sums-total" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_zz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jz" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_qk" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jc" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                                <div class="layui-input-inline" style="width: 80px;">
                                    <input type="text" name="project_jy" autocomplete="off" class="layui-input" value="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn layui-input-block layui-btn-sm" data-origin-id="3" style="width: 95%; margin-left: 0;" id="lzright">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
@endsection

@section('scripts')
<script>
layui.use(['layer', 'form'], function () {
    var $ = layui.$,
        layer = layui.layer;

    $('#dhleft').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#dhleftinput').find('input[name=project_zz]').val(),
                    project_jz: $('#dhleftinput').find('input[name=project_jz]').val(),
                    project_qk: $('#dhleftinput').find('input[name=project_qk]').val(),
                    project_jc: $('#dhleftinput').find('input[name=project_jc]').val(),
                    project_jy: $('#dhleftinput').find('input[name=project_jy]').val(),
                    sum: $('#dhleftinput').find('input[name=sum]').val(),
                    status: 0
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })

    $('#dhright').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#dhrightinput').find('input[name=project_zz]').val(),
                    project_jz: $('#dhrightinput').find('input[name=project_jz]').val(),
                    project_qk: $('#dhrightinput').find('input[name=project_qk]').val(),
                    project_jc: $('#dhrightinput').find('input[name=project_jc]').val(),
                    project_jy: $('#dhrightinput').find('input[name=project_jy]').val(),
                    sum: $('#dhrightinput').find('input[name=sum]').val(),
                    status: 1
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })

    $('#jdleft').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#jdleftinput').find('input[name=project_zz]').val(),
                    project_jz: $('#jdleftinput').find('input[name=project_jz]').val(),
                    project_qk: $('#jdleftinput').find('input[name=project_qk]').val(),
                    project_jc: $('#jdleftinput').find('input[name=project_jc]').val(),
                    project_jy: $('#jdleftinput').find('input[name=project_jy]').val(),
                    sum: $('#jdleftinput').find('input[name=sum]').val(),
                    status: 0
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })

    $('#jdright').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#jdrightinput').find('input[name=project_zz]').val(),
                    project_jz: $('#jdrightinput').find('input[name=project_jz]').val(),
                    project_qk: $('#jdrightinput').find('input[name=project_qk]').val(),
                    project_jc: $('#jdrightinput').find('input[name=project_jc]').val(),
                    project_jy: $('#jdrightinput').find('input[name=project_jy]').val(),
                    sum: $('#jdrightinput').find('input[name=sum]').val(),
                    status: 1
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })

    $('#lzleft').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#lzleftinput').find('input[name=project_zz]').val(),
                    project_jz: $('#lzleftinput').find('input[name=project_jz]').val(),
                    project_qk: $('#lzleftinput').find('input[name=project_qk]').val(),
                    project_jc: $('#lzleftinput').find('input[name=project_jc]').val(),
                    project_jy: $('#lzleftinput').find('input[name=project_jy]').val(),
                    sum: $('#lzleftinput').find('input[name=sum]').val(),
                    status: 0
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })

    $('#lzright').on('click', function (e) {
        if ($("#platform").val() == 0) {
            layer.alert('请先选择一个平台');
        } else {
            $.ajax({
                url: '{{ route('sums') }}',
                method: 'POST',
                data: {
                    platform_id: $("#platform").val(),
                    origin_id: $(this).data('origin-id'),
                    project_zz: $('#lzrightinput').find('input[name=project_zz]').val(),
                    project_jz: $('#lzrightinput').find('input[name=project_jz]').val(),
                    project_qk: $('#lzrightinput').find('input[name=project_qk]').val(),
                    project_jc: $('#lzrightinput').find('input[name=project_jc]').val(),
                    project_jy: $('#lzrightinput').find('input[name=project_jy]').val(),
                    sum: $('#lzrightinput').find('input[name=sum]').val(),
                    status: 1
                },
                beforeSend: function () {
                    layer.load();
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code === 0) {
                        layer.msg(res.msg, {
                            offset: '15px'
                            , icon: 1
                            , time: 1000
                        }, function () {
                            layer.close(); //关闭弹层
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            })
        }
    })
})
</script>
@endsection
