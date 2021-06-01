@extends('layouts.app')

@section('content')
<div class="layui-card">
    <div class="layui-card-body">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>数据筛选</legend>
        </fieldset>

        <div class="layui-btn-container">
{{--            @foreach ($users as $user)--}}
{{--                <a href="{{ route('admin.index') . '/?id=' . $user->id }}" class="layui-btn {{ substr(Request::getQueryString(), 3) == $user->id ? '' : 'layui-btn-primary layui-border-green' }}">{{ $user->username }}</a>--}}
{{--            @endforeach--}}
        </div>

        <fieldset class="layui-elem-field">
            <legend>数据汇总</legend>
            <div class="layui-field-box">
                <div class="layui-row">
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsCount }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入矫正客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入种植客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入全科客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入洁牙客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">录入检查客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsJc }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">特邀客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointment }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约矫正客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约种植客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约全科客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约洁牙客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约检查客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentJc }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店矫正客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_storeJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店种植客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_storeZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店全科客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_storeQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店洁牙客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_storeJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到店检查客户数</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_storeJc }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">总业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievement }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">矫正业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievementJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">种植业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievementZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">全科业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievementQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">洁牙业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievementJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">检查业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $achievementJc }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRate }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">矫正预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRateJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">种植预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRateZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">全科预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRateQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">洁牙预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRateJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">检查预约率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $appointmentRateJc }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rate }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">矫正到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rateJz }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">种植到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rateZh }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">全科到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rateQk }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">洁牙到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rateJy }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">检查到诊率</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $to_store_rateJc }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="layui-elem-field">
            <legend>工作汇总</legend>
            <div class="layui-field-box">
                <div class="layui-row">
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">已回访数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $repaysCount }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">转介绍业绩</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $isIntroduceMany }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">待回访数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $waitRepaysCount }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">转介绍意向</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $introduceCount }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">加微数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $addWechatCount }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">流入公海数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $patientsseasCount }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs2">
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">未加微数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">{{ $waitWechatCount }}</button>
                            </div>
                        </div>
                        <div class="layui-btn-container">
                            <div class="layui-btn-group">
                                <button type="button" class="layui-btn">公海申请数量</button>
                                <button type="button" class="layui-btn layui-btn-primary">0</button>
                            </div>
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
        var layer = layui.layer,
            form = layui.form,
            $ = layui.$;

        form.on('select(users)', function (data) {

        })
    })
</script>
@endsection
