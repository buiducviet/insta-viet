<script type="text/javascript">
    $(document).ready(function () {
        var title = '';
        $('.sidebar-item').each(function(){
            if ($(this).attr('href')==$(location).attr('href')) {
                $(this).addClass('active');
                title += $(this).text();
                // $(this).on('click', function(){
                //     return false;
                // });
            }
        });
        $('.sidebar-parrent').each(function(){
            if ($(this).find('.active').length>0) {
                $(this).addClass('active');
                title = $(this).find('.sidebar-nav-menu').text() + ' - ' + title;
            }
        });

        if (title.length) {
            $('head title').text(title);
        }
    });
</script>
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">

            <!-- User Info -->
            @include('admin/layouts.sidebar.user-info')
            <!-- END User Info -->
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="{{route('admin')}}" class="<?php echo \URL::current()==route('admin')? 'active':''; ?>"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Trang bắt đầu</span></a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('clients')}}">
                        <i class="fa fa-list-ol sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Frontends</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('setting_popular_user')}}">
                        <i class="fa fa-user sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Popular users</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('groups')}}">
                        <i class="fa fa-list sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Groups</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('admin_tags')}}">
                        <i class="fa fa-tags sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Tags</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('admin_article')}}">
                        <i class="fa fa-newspaper-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Tin Tức</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-item" href="{{route('admin_feedback')}}">
                        <i class="fa fa-bullhorn sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Feedback</span>
                    </a>
                </li>
                <li class="sidebar-parrent">
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-cogwheels sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Setting</span>
                    </a>
                    <ul>
                        <li>
                            <a class="sidebar-item" href="{{route('setting_account')}}">Accounts</a>
                        </li>
                        <li>
                            <a class="sidebar-item" href="{{route('setting_sitemap_tags')}}">Sitemap tags</a>
                        </li>
                        <li>
                            <a class="sidebar-item" href="{{route('setting_sitemap_users')}}">Sitemap users</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->

            <!-- Sidebar Notifications -->
            {{-- @include('admin.layouts.sidebar.notification') --}}
            <!-- END Sidebar Notifications -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>