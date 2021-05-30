@extends('layouts.app')
@section('title', '平台展示')

@section('content')
<div class="layui-card" style="margin-bottom: 50px;">
    <div class="layui-card-header p-t-15 border-b-0" style="height: auto;">
        <div style="margin-bottom: 15px;">
            <div class="layui-layout-right" style="padding-right: 20px; padding-top: 15px;">
                <span>责任人：</span>
                <span>{{ $platform->user->username }}</span>
            </div>
            <div class="layui-form">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <select name="city" lay-verify="required">
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-btn-container layui-clear" style="float: left;">
            <button class="layui-btn layui-btn-sm btn-date" value="default">全部</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="today">今天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="yesterday">昨天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="threeDay">最近三天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="sevenDay">最近一周</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="fifteenDay">最近15天</button>
            <button class="layui-btn layui-btn-sm layui-btn-primary btn-date" value="thirtyDay">最近一个月</button>
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
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
            <legend>对话</legend>
        </fieldset>
        <div class="layui-btn-container count-list">
            <div class="layui-row">
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">预约数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电率</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">到店人数</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">业绩</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
            <legend>进电</legend>
        </fieldset>
        <div class="layui-btn-container count-list">
            <div class="layui-row">
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">预约数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电率</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">到店人数</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">业绩</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
            <legend>留咨</legend>
        </fieldset>
        <div class="layui-btn-container count-list">
            <div class="layui-row">
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">预约数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电数量</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">套电率</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">到店人数</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
                <div class="layui-col-md2">
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">业绩</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">矫正</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">种植</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">全科</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">检查</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                    <div class="layui-btn-group">
                        <span class="layui-btn layui-btn-primary layui-bg-gray">洁牙</span>
                        <span class="layui-btn layui-btn-primary">25</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
