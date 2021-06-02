<div class="xm-select-role" id="xm-select-role"></div>
<script>
layui.use(['form', 'layer'], function () {
    var $ = layui.$,
        form = layui.form,
        layer = layui.layer;

    $.ajax({
        method: 'POST',
        url: '{{ route('api.getRoleByUserId', ['user_id' => $user_id ?? 0]) }}',
        dataType: 'json',
        success: function (res) {
            var demo = xmSelect.render({
                el: '#xm-select-role',
                name: 'role_ids',
                prop: {
                    name: 'display_name',
                    value: 'id'
                },
                data: res.data
            })
        }
    });
})
</script>
