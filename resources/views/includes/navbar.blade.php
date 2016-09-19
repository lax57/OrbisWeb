
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul id="side-menu" class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                    <span></span>
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- BEGIN LOGO -->
            <li class="nav-item logo-client">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>

            <!-- END LOGO -->
            <li id="courses" class="nav-item start active open">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Twoje kursy</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @foreach($courses as $course)
                    <li class="nav-item start active">
                        <a href="#" class="nav-link submit-filter-link">
                            <span class="title">{{$course->name}} {{$course->level}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li id="your-courses" class="nav-item  ">
                <a href="#" class="nav-link submit-filter-link">
                    <i class="fa fa-clock-o"></i>
                    <span class="title">Przegladaj</span>
                </a>
            </li>


            <li class="session_control nav-item">
                <a href="{{ route('logout') }}" class="nav-link nav-toggle">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">Wyloguj</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>

    <!-- END SIDEBAR -->
</div>