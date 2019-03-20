<div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
    <div class="sidebar-user-avatar">
        <a href="{{route('admin')}}">
            <img src="{{asset('themes/admin/img/placeholders/avatars/avatar2.jpg')}}" alt="avatar">
        </a>
    </div>
    <div class="sidebar-user-name">{{\Auth::user()->name}}</div>
    <div class="sidebar-user-links">
        <a href="{{route('logout')}}" data-toggle="tooltip" data-placement="bottom" title="Đăng xuất" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="gi gi-exit"></i></a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
        </form>
    </div>
</div>