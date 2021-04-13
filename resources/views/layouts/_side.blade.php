<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">员工管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ route('admins.index') }}">员工列表</a></dd>
                    <dd><a href="{{ route('admins.create') }}">添加员工</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{ route('patients.index') }}">我的患者</a></li>
            <li class="layui-nav-item"><a href="{{ route('patients.create') }}">添加患者</a></li>
        </ul>
    </div>
</div>
