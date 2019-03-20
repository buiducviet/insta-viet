<header>
    <div class="container">
        <!-- Site Logo -->
        <a href="{{ route('home') }}" class="site-logo">
            <img src="{{ \App\Helper::media(MetaTag::get('logo')) }}" alt="logo" class="img-responsive">
        </a>
        <!-- Site Logo -->

        <!-- Site Navigation -->
        <nav>
            <!-- Menu Toggle -->
            <!-- Toggles menu on small screens -->
            <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                <i class="fa fa-bars"></i>
            </a>
            <!-- END Menu Toggle -->

            <!-- Main Menu -->
            <ul class="site-nav">
                <!-- Toggles menu on small screens -->
                <li class="visible-xs visible-sm">
                    <a href="javascript:void(0)" class="site-menu-toggle text-center">
                        <i class="fa fa-times"></i>
                    </a>
                </li>
                <!-- END Menu Toggle -->
                <li>
                    <a href="{{ route('home') }}" class="home-url"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="{{ route('popular_photos') }}">{{ config('config.menu.trending_photo.name') }}</a>
                </li>
                <li>
                    <a href="{{ route('popular_users') }}">{{ config('config.menu.popular_users.name') }}</a>
                </li>
                <li>
                    <a href="{{ route('locations') }}">{{ config('config.menu.locations.name') }}</a>
                </li>
                <li>
                    <a href="{{ route('base_search') }}">Search</a>
                </li>
                {{-- @if(auth()->check())
                <li>
                    <a href="{{ route('profile') }}">Profile</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="redirect" value="{{ url()->full() }}">
                    </form>
                </li>
                @else
                <li>
                    <a href="{{ route('facebook.login') }}" class="btn btn-info"><i class="fa fa-facebook"></i> Login</a>
                </li>
                @endif --}}
            </ul>
            <!-- END Main Menu -->
        </nav>
        <!-- END Site Navigation -->
    </div>
</header>