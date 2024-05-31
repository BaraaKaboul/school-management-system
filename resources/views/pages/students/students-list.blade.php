@extends('layouts.master')
@section('css')

@endsection
@section('title')
    empty
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                                   aria-pressed="true">{{trans('main_trans.add_student')}}</a><br><br>
                                                <div class="table-responsive">
                                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                                           data-page-length="50"
                                                           style="text-align: center">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{trans('Students_trans.name')}}</th>
                                                            <th>{{trans('Students_trans.email')}}</th>
                                                            <th>{{trans('Students_trans.gender')}}</th>
                                                            <th>{{trans('Students_trans.Grade')}}</th>
                                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                                            <th>{{trans('Students_trans.section')}}</th>
                                                            <th>{{trans('Students_trans.Processes')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($students as $student)
                                                            <tr>
{{--                                                                مشان الترقيم بدال مااعمل متغير بالphp وكذا فهاي اسرع واسهل--}}
                                                                <td>{{ $loop->index+1 }}</td>
                                                                <td>{{$student->name}}</td>
                                                                <td>{{$student->email}}</td>
                                                                <td>{{$student->gender->Name}}</td>
                                                                <td>{{$student->grade->name}}</td>
                                                                <td>{{$student->classroom->class_name}}</td>
                                                                <td>{{$student->section->section_name}}</td>
                                                                <td>
                                                                    <div class="dropdown show">
                                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            العمليات
                                                                        </a>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                            <a class="dropdown-item" href="{{route('students.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                                                                            <a class="dropdown-item" href="{{route('students.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                                            <a class="dropdown-item" href="{{route('fees-invoices.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                                                            <a class="dropdown-item" href="{{route('receipt-student.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;سند قبض</a>
                                                                            <a class="dropdown-item" href="{{route('processing-fees.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;استبعاد رسوم</a>
                                                                            <a class="dropdown-item" href="{{route('payment-student.show',$student->id)}}"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp; &nbsp;سند صرف</a>
                                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="#Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;{{ trans('Grades_trans.Delete') }}</a>
                                                                            <a class="btn btn-add-todo" data-target="#Graduate_Student{{ $student->id }}" data-toggle="modal"><i style="color: white" class="fa fa-arrow-up"></i>&nbsp;تخريج طالب</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @include('pages.students.delete')
                                                        @include('pages.students.graduates.graduate-one-student')
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row closed -->
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
