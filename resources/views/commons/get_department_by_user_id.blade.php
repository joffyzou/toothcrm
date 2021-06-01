<div class="xm-select-department" id="xm-select-department"></div>
<script>
layui.use(['form', 'layer'], function () {
    var $ = layui.$;
    var form = layui.form;
    var layer = layui.layer;
    // 一般来说，数据是异步传递过来的
    $.ajax({
        method: 'post',
        url: '{{route('api.getDepartmentByUserId',['user_id'=>$user_id??null])}}',
        dataType: 'json',
        success: function (res) {
            var demo1 = xmSelect.render({
                el: '#xm-select-department',
                name: 'department_id',
                model: { label: { type: 'text' } },
                radio: true,
                clickClose: true,
                prop: {
                    name: 'name',
                    value: 'id',
                },
                tree: {
                    show: true,
                    showLine: false,
                    strict: false,
                    expandedKeys: true,
                },
                data: res.data,
            })
        }
    });
});
</script>
