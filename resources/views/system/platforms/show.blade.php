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
        <fieldset class="layui-elem-field layui-field-title">
            <legend>对话</legend>
        </fieldset>
        <div class="layui-form layui-form-pane">
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">对话数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">套电数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">套电率</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">到店人数</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title">
            <legend>进电</legend>
        </fieldset>
        <div class="layui-form layui-form-pane">
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">进电数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">到店人数</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title">
            <legend>留咨</legend>
        </fieldset>
        <div class="layui-form layui-form-pane">
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">留咨数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">到店人数</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-inline" style="width: 175px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="100" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="25" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
layui.use(['table', 'laydate'], function () {
    var $ = layui.$,
        table = layui.table,
        laydate = layui.laydate;

    laydate.render({
        elem: '#dateSearch',
        type: 'datetime',
        range: ['#startDate', '#endDate']
    });

    $('#dateSearchBtn').on('click', function () {
        table.reload('dataTable', {
            url: "{{ route('crm.seas.index') }}",
            where: {
                startDate: $('#startDate').val(),
                endDate: $('#endDate').val()
            }
        })
    })

    $('.btn-date').each(function (i, e) {
        $(e).on('click', function () {
            $(this).removeClass('layui-btn-primary');
            $(this).siblings().addClass('layui-btn-primary');
            table.reload('dataTable', {
                url: "{{ route('crm.seas.index') }}",
                where: {
                    date : $(e).val()
                }
            });
        })
    });
})
</script>
@endsection
