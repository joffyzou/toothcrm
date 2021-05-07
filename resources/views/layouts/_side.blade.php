<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            {{-- <li class="layui-nav-item">
                <a href="javascript:;">员工管理</a>
                <dl class="layui-nav-child">
                    <dd class="layui-this"><a href="{{ route('admins.index') }}">员工列表</a></dd>
                    <dd><a href="{{ route('admins.create') }}">添加员工</a></dd>
                </dl>
            </li> --}}
            <li class="layui-nav-item"><a href="{{ route('admin.index') }}">数据概览</a></li>
            @if (Auth::user()->role_id == 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                <li class="layui-nav-item"><a href="{{ route('admin.users.index') }}">我的员工</a></li>
            @endif
            <li class="layui-nav-item"><a href="{{ route('admin.users.patients', Auth::user()) }}">我的患者</a></li>
            <li class="layui-nav-item"><a href="{{ route('admin.patients.create') }}">添加患者</a></li>
            @if (Auth::user()->role_id <= 1)
                <li class="layui-nav-item"><a href="{{ route('admin.patients.index') }}">患者公海</a></li>
            @endif
        </ul>
    </div>
</div>
