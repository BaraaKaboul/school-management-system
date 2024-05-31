<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{url('/dashboard')}}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main-sidebar_trans.dashboard')}}</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main-sidebar_trans.header_sidebar')}} </li>
        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.grades')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('grade.index')}}">{{trans('main-sidebar_trans.grades_list')}}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.classes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('classroom.index')}}">{{trans('main-sidebar_trans.study_class')}}</a> </li>
            </ul>
        </li>
        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.sections')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('section.index')}}">{{trans('sections_trans.sections_list')}}</a> </li>
            </ul>
        </li>
        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{trans('main-sidebar_trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main-sidebar_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{route('students.create')}}">{{trans('main-sidebar_trans.add_student')}}</a></li>
                        <li> <a href="{{route('students.index')}}">{{trans('main-sidebar_trans.students_list')}}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main-sidebar_trans.promotion_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{route('promotions.index')}}">{{trans('main-sidebar_trans.add_Promotion')}}</a></li>
                        <li> <a href="{{route('promotions.create')}}">{{trans('main-sidebar_trans.list_Promotions')}}</a> </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main-sidebar_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{route('graduates.create')}}">{{trans('main-sidebar_trans.add_Graduate')}}</a> </li>
                        <li> <a href="{{route('graduates.index')}}">{{trans('main-sidebar_trans.list_Graduate')}}</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- menu item Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.teachers')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('teachers.index')}}">{{trans('main-sidebar_trans.teachers_list')}}</a> </li>
            </ul>
        </li>
        <!-- menu item Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.parents')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{url('add-parents')}}">{{trans('main-sidebar_trans.parents_list')}} </a> </li>
            </ul>
        </li>
        <!-- menu font Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{trans('main-sidebar_trans.accounts')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('fees.index')}}">{{trans('fee_trans.study_fees')}}</a> </li>
                <li> <a href="{{route('fees-invoices.index')}}">{{trans('main-sidebar_trans.invoices')}}</a> </li>
                <li> <a href="{{route('receipt-student.index')}}">{{trans('main-sidebar_trans.receipt')}}</a> </li>
                <li> <a href="{{route('processing-fees.index')}}">{{trans('main-sidebar_trans.Exclude_fees')}}</a> </li>
                <li> <a href="{{route('payment-student.index')}}">{{trans('main-sidebar_trans.Bills_of_exchange')}}</a> </li>
            </ul>
        </li>
        <!-- menu Attendance -->
        {{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Widgets, Forms & Tables </li>--}}
        <!-- menu item Widgets-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('main-sidebar_trans.pre-up_sence')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('attendance.index')}}">{{trans('main-sidebar_trans.students_list')}}</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li>
        <!-- menu item Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('main-sidebar_trans.exams')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('subject.index')}}">{{trans('main-sidebar_trans.subject_study_list')}}</a> </li>
                <li> <a href="{{route('quiz.index')}}">{{trans('main-sidebar_trans.quiz_list')}}</a> </li>
                <li> <a href="{{route('question.index')}}">{{trans('main-sidebar_trans.question_list')}}</a> </li>
            </ul>
        </li>
        <!-- menu item library -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('main-sidebar_trans.library')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('library.index')}}">{{trans('main-sidebar_trans.study_books')}}</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li>
        {{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">More Pages</li>--}}
        <!-- menu item online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main-sidebar_trans.online_lessons')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('online-class.index')}}">{{trans('main-sidebar_trans.live_connect_with_zoom')}}</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li>
        <!-- menu item Settings-->
        <li>
            <a href="{{url('setting')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('main-sidebar_trans.settings')}}</span></a>
        </li>
        <!-- menu item Users-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('main-sidebar_trans.users')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li>
    </ul>
</div>
