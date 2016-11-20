
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul id="side-menu" class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">
            <?php $user_courses = Auth::User()->courses; ?>
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            
            <li class="nav-item logo-dashboard">
                <a href="{{route('user_courses')}}">Dashboard</a>
            </li>
            <li id="your-courses" class="nav-item nav-button-dropdown {{ Request::is('user_courses','course_page/*') ? 'active open' : '' }}">
                <a class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">{{trans('navbar.your_courses') }}</span>
                    <span class="arrow {{ Request::is('user_courses') ? 'open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ Request::is('user_courses') ? 'active' : '' }}">
                        <a href="{{ route('user_courses') }}" class="nav-link submit-filter-link">
                            <span class="title">{{trans('navbar.all') }}</span>
                        </a>
                    </li>
                    @foreach($user_courses as $course)
                    <li class="nav-item {{ Request::is('course_page/'.$course->id.'*') ? 'active' : '' }} ">
                        <a href="{{route('course_page', ['course_id' => $course->id])}}" class="nav-link submit-filter-link">
                            <span class="title">{{$course->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li id="all-courses" class="nav-item nav-button-dropdown {{ Request::is('all_courses') ? 'active open' : '' }}">
                <a class="nav-link submit-filter-link">
                    <i class="fa fa-clone"></i>
                    <span class="title">{{trans('navbar.browse') }}</span>
                    <span class="arrow {{ Request::is('all_courses') ? 'open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ Request::is('all_courses') ? 'active' : '' }}">
                        <a href="{{ route('all_courses') }}" class="nav-link submit-filter-link">
                            <span class="title">{{trans('navbar.all') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="session_control nav-item">
                <a href="{{ route('logout') }}" class="nav-link nav-toggle">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">Wyloguj</span>
                </a>
            </li>
        </ul>
    </div>
</div>