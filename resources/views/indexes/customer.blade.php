@extends('layouts.app')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header p-t-15 border-b-0" style="height: auto;">
            <div style="margin-bottom: 15px; height: 43px;">
                <div class="layui-layout-right" style="padding-right: 20px; padding-top: 15px;">
                    <div class="layui-form layui-input-inline">
                        <select name="users" lay-verify="required" lay-filter="users">
                            <option value="0">全客服部</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ Request::input('user_id') == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-btn-container layui-clear" style="float: left;">
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=all" class="layui-btn layui-btn-sm btn-date {{ empty(Request::getQueryString()) || Request::input('date') == 'all' ? '' : 'layui-btn-primary' }}">全部</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=today" class="layui-btn layui-btn-sm {{ Request::input('date') == 'today' ? '' : 'layui-btn-primary' }}">今天</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=yesterday" class="layui-btn layui-btn-sm {{ Request::input('date') == 'yesterday' ? '' : 'layui-btn-primary' }}">昨天</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=threeDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'threeDay' ? '' : 'layui-btn-primary' }}">最近三天</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=sevenDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'sevenDay' ? '' : 'layui-btn-primary' }}">最近一周</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=fifteenDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'fifteenDay' ? '' : 'layui-btn-primary' }}">最近15天</a>
                <a href="/customer?user_id={{ Request::input('user_id') }}&&date=thirtyDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'thirtyDay' ? '' : 'layui-btn-primary' }}">最近一个月</a>
            </div>
            <div class="layui-inline layui-form-item" style="margin-top: -16px; margin-bottom: 0;">
                <label class="layui-form-label">日期范围</label>
                <div class="layui-inline" id="dateSearch" style="margin: 0;">
                    <div class="layui-input-inline">
                        <input type="text" name="startDate" id="startDate" class="layui-input" placeholder="开始日期">
                    </div>
                    <div class="layui-form-mid">-</div>
                    <div class="layui-input-inline" style="margin: 0;">
                        <input type="text" name="endDate" id="endDate" class="layui-input" placeholder="结束日期">
                    </div>
                </div>
                <button class="layui-btn" id="dateSearchBtn" data-type="reload">搜索</button>
            </div>
        </div>

        <div class="layui-card-body">
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
layui.use(['layer', 'form', 'laydate'], function () {
    var layer = layui.layer,
        form = layui.form,
        $ = layui.$,
        laydate = layui.laydate;

    laydate.render({
        elem: '#dateSearch',
        type: 'datetime',
        range: ['#startDate', '#endDate']
    });

    $('#dateSearchBtn').on('click', function () {
        window.location.href = '/customer?user_id={{ Request::input('user_id') }}' + '&&startDate=' + $('#startDate').val() + '&&endDate=' + $('#endDate').val();
    });

    form.on('select(users)', function (e) {
        window.location.href = '?user_id=' + e.value + '&&date=all';
    })
})
</script>
@endsection
