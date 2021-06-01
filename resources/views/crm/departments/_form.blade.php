@csrf
<div class="layui-form-item">
    <label for="" class="layui-form-label">部门名称</label>
    <div class="layui-input-block">
        <input type="hidden" name="parent_id" value="{{ $parent_id ?? 0 }}">
        <input class="layui-input" type="text" name="name" lay-verify="required" value="{{ $model->name ?? '' }}" placeholder="请输入名称">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">部门经理</label>
    <div class="layui-input-block">
        @include('commons.get_user', ['user_id' => $model->user_id ?? 0])
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="button" class="layui-btn layui-btn-sm" lay-submit lay-filter="go-close" >确认</button>
    </div>
</div>
