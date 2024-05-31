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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المادة الدراسية</th>
                                            <th>اسم الاختبار</th>
                                            <th>دخول / درجة الاختبار</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>
                                                    @if($quizze->degree->count() > 0 && $quizze->id == $quizze->degree[0]->quizze_id)
                                                        {{$quizze->degree[0]->score}}
                                                    @else
                                                    <a href="{{route('student-exam.show',$quizze->id)}}"
                                                       class="btn btn-outline-success btn-sm" role="button"
                                                       aria-pressed="true" onclick="alertAbuse()">
                                                        <i class="fas fa-person-booth"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
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
@endsection
@section('js')
    <script>
        function alertAbuse() {
            alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
        }
    </script>
@endsection
