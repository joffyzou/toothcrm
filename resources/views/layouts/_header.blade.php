<div class="layui-header">
    <div class="layui-logo">Toothcrm-admin</div>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ Auth::user()->username }}</a>
            <dl class="layui-nav-child">
                <dd><a href="">set 1</a></dd>
                <dd><a href="">set 2</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item">
            <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                @csrf
                <a><button type="submit" style="border:none; outline: none; cursor: hand; cursor: pointer; background-color: transparent; color:#fff;color:rgba(255,255,255,.7);">退出</button></a>
            </form>
        </li>
    </ul>
</div>
