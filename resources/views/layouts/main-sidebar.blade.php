<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">

            @if(auth('student')->check())
                @include('layouts.main sidebar.student-main-sidebar')

            @elseif(auth('teacher')->check())
                @include('layouts.main sidebar.teacher-main-sidebar')

            @elseif(auth('parent')->check())
                @include('layouts.main sidebar.parent-main-sidebar')

            @else
                @include('layouts.main sidebar.admin-main-sidebar')

            @endif


        </div>

        <!-- Left Sidebar End-->

        <!--=================================
