<div class="layui-header">
    <div class="layui-logo">Toothcrm-admin</div>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ Auth::user()->username }}<span class="layui-badge">9</span></a>
        </li>
        <li class="layui-nav-item">
            <form action="{{ route('admin.logout') }}" method="POST" id="logout">
                @csrf
                @method('DELETE')
                <a href="javascript:void(0)" onclick="document.getElementById('logout').submit();return false;">退出</a>
            </form>
        </li>
    </ul>
</div>

