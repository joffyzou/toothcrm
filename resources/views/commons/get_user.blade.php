<div id="xm-select-user" class="xm-select-user"></div>
<script>
    layui.use(['form', 'layer'], function () {
        var $ = layui.$,
            form = layui.form,
            layer = layui.layer;

        $.ajax({
            method: 'POST',
            url: "{{ route('api.getUser', ['user_id' => $user_id ?? 0]) }}",
            dataType: 'json',
            success: function (res) {
                var demo1 = xmSelect.render({
                    el: '#xm-select-user',
                    name: 'user_id',
                    filterable: true,
                    radio: true,
                    clickClose: true,
                    model: { label: { type: 'text' } },
                    prop: {
                        name: 'username',
                        value: 'id',
                    },
                    data: res.data,
                })
            }
        });
    })
</script>
