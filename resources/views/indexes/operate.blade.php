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
                            <select name="city" lay-verify="required" lay-filter="platforms">
                                <option value="0">全平台</option>
                                @foreach ($platforms as $d)
                                    <option value="{{ $d->id }}" {{ Request::input('platform_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-btn-container layui-clear" style="float: left;">
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=all" class="layui-btn layui-btn-sm btn-date {{ empty(Request::getQueryString()) || Request::input('date') == 'all' ? '' : 'layui-btn-primary' }}">全部</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=today" class="layui-btn layui-btn-sm {{ Request::input('date') == 'today' ? '' : 'layui-btn-primary' }}">今天</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=yesterday" class="layui-btn layui-btn-sm {{ Request::input('date') == 'yesterday' ? '' : 'layui-btn-primary' }}">昨天</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=threeDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'threeDay' ? '' : 'layui-btn-primary' }}">最近三天</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=sevenDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'sevenDay' ? '' : 'layui-btn-primary' }}">最近一周</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=fifteenDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'fifteenDay' ? '' : 'layui-btn-primary' }}">最近15天</a>
                <a href="/operate?platform_id={{ Request::input('platform_id') }}&&date=thirtyDay" class="layui-btn layui-btn-sm {{ Request::input('date') == 'thirtyDay' ? '' : 'layui-btn-primary' }}">最近一个月</a>
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
                            <input type="text" name="origin_sum" data-origin-id="2" class="layui-input sums-total" value="">
                        </div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="valid_sum" autocomplete="off" class="layui-input sums-total" value="">
                        </div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyy }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyyjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyyzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyyqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyyjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyyjy }}" disabled>
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
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhdd }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhddjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhddzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhddqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhddjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhddjy }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyj }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyjjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyjzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyjqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyjjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $dhyjjy }}" disabled>
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
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                        </div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyy }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyyjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyyzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyyqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyyjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyyjy }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">到店人数</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jddd }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdddjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdddzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdddqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdddjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdddjy }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyj }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyjjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyjzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyjqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyjjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $jdyjjy }}" disabled>
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
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">有效数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="">
                        </div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0; color: red;">{{ $project->name }}</label>
                            <div class="layui-input-inline" style="width: 80px;">
                                <input type="text" name="number[{{ $project->id }}]" autocomplete="off" class="layui-input" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">预约数量</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyy }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyyjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyyzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyyqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyyjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyyjy }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">到店人数</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzdd }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzddjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzddzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzddqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzddjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzddjy }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="layui-inline" style="width: 175px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">业绩</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyj }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">矫正</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyjjz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">种植</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyjzz }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">全科</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyjqk }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">检查</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyjjc }}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 80px; padding-left: 0; padding-right: 0;">洁牙</label>
                        <div class="layui-input-inline" style="width: 80px;">
                            <input type="text" name="number" autocomplete="off" class="layui-input" value="{{ $lzyjjy }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        layui.use(['laydate', 'form'], function () {
            var $ = layui.$,
                form = layui.form,
                laydate = layui.laydate;

            laydate.render({
                elem: '#dateSearch',
                type: 'datetime',
                range: ['#startDate', '#endDate']
            });

            $('#dateSearchBtn').on('click', function () {
                window.location.href = '/operate?platform_id={{ Request::input('platform_id') }}' + '&&startDate=' + $('#startDate').val() + '&&endDate=' + $('#endDate').val();
            });

            form.on('select(platforms)', function (e) {
                window.location.href = '?platform_id=' + e.value + '&&date=all';
            })

            $('#test889').on('blur', function (e) {
                $.ajax({
                    url: '{{ route('sums') }}',
                    method: 'POST',
                    data: {
                        'platform_id': $(this).data('platform-id'),
                        'origin_id': $(this).data('origin-id'),
                        'origin_sum': this.value
                    },
                    success: function (e) {
                        console.log(e);
                    }
                })
            })
        })
    </script>
@endsection
