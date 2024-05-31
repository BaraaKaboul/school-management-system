@extends('layouts.master')
@section('css')

@endsection
@section('title')
    اضافة اختبار جديد
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">اضافة اختبار جديد</h4>
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

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('quiz.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">اسم الاختبار باللغة العربية</label>
                                        <input type="text" name="Name_ar" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">اسم الاختبار باللغة الانجليزية</label>
                                        <input type="text" name="Name_en" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">المادة الدراسية : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id">
                                                <option selected disabled>حدد المادة الدراسية...</option>
                                                @foreach($subjects as $subject)
                                                    <option  value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">اسم المعلم : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>حدد اسم المعلم...</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
