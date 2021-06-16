<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
{{--             <li class="layui-nav-item">--}}
{{--                <a href="javascript:;">员工管理</a>--}}
{{--                <dl class="layui-nav-child">--}}
{{--                    <dd class="layui-this"><a href="#">员工列表</a></dd>--}}
{{--                    <dd><a href="#">添加员工</a></dd>--}}
{{--                </dl>--}}
{{--            </li>--}}

            <li class="layui-nav-item {{ Request::is('operate') ? 'layui-this' : '' }}"><a href="{{ route('operate.index') }}">运营数据</a></li>
            <li class="layui-nav-item {{ Request::is('customer') ? 'layui-this' : '' }}"><a href="{{ route('customer') }}">客服数据</a></li>
            @role('root|admin|manager')
            <li class="layui-nav-item {{ Request::is('system/users') || Request::is('system/users/*') ? 'layui-this' : '' }}"><a href="{{ route('system.users.index') }}">用户管理</a></li>
            <li class="layui-nav-item {{ Request::is('system/roles') || Request::is('system/roles/*') ? 'layui-this' : '' }}"><a href="{{ route('system.roles.index') }}">角色管理</a></li>
            <li class="layui-nav-item {{ Request::is('system/permissions') || Request::is('system/permissions/*') ? 'layui-this' : '' }}"><a href="{{ route('system.permissions.index') }}">权限管理</a></li>
            <li class="layui-nav-item {{ Request::is('crm/departments') || Request::is('crm/departments/*') ? 'layui-this' : '' }}"><a href="{{ route('crm.departments.index') }}">部门管理</a></li>
            <li class="layui-nav-item {{ Request::is('system/platforms') || Request::is('system/platforms/*') ? 'layui-this' : '' }}"><a href="{{ route('system.platforms.index') }}">平台管理</a></li>
            @endrole


            <li class="layui-nav-item {{ Request::is('crm/patients') || Request::is('crm/patients/*') ? 'layui-this' : '' }}"><a href="{{ route('crm.patients.index') }}">患者管理</a></li>
            @can('crm.seas')
            <li class="layui-nav-item {{ Request::is('crm/seas') || Request::is('crm/seas/*') ? 'layui-this' : '' }}"><a href="{{ route('crm.seas.index') }}">患者公海</a></li>
            @endcan

{{--            <li class="layui-nav-item {{ Request::path() == 'admin' ? 'layui-this' : '' }}"><a href="{{ route('admin.index') }}">数据概览</a></li>--}}
{{--            @if (Auth::user()->role_id == 0 || Auth::user()->role_id == 1 || Auth::user()->role_id == 3)--}}
{{--                <li class="layui-nav-item {{ Request::path() == 'admin/users' ? 'layui-this' : '' }}"><a href="{{ route('system.users.index') }}">我的员工</a></li>--}}
{{--            @endif--}}

{{--            @can ('isAdmin', Auth::user())--}}
{{--                <li class="layui-nav-item">--}}
{{--                    <a href="javascript:;">平台管理</a>--}}
{{--                    <dl class="layui-nav-child">--}}
{{--                        <dd class="layui-this"><a href="{{ route('system.platforms.index') }}">平台列表</a></dd>--}}
{{--                        <dd><a href="#">添加员工</a></dd>--}}
{{--                    </dl>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            <li class="layui-nav-item">--}}
{{--                <a href="javascript:;">患者管理</a>--}}
{{--                <dl class="layui-nav-child">--}}
{{--                    <dd class="{{ Request::path() == 'admin/users/' . Auth::id() . '/patients' ? 'layui-this' : '' }}">--}}
{{--                        <a href="{{ route('crm.users.patients', Auth::user()) }}">我的患者</a>--}}
{{--                    </dd>--}}
{{--                    <dd class="{{ Request::path() == 'admin/patients/create' ? 'layui-this' : '' }}">--}}
{{--                        <a href="{{ route('crm.patients.create') }}">添加患者</a>--}}
{{--                    </dd>--}}
{{--                    @can ('isAdmin', Auth::user())--}}
{{--                        <dd class="{{ Request::path() == 'admin/patients' ? 'layui-this' : '' }}"><a href="{{ route('crm.patients.index') }}">患者公海</a></dd>--}}
{{--                    @endcan--}}
{{--                </dl>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
