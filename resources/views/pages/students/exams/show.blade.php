@extends('layouts.master')
@section('css')

@endsection
@section('title')
    أجراء اختبار
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">أجراء اختبار</h4>
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
    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])
@endsection
@section('js')
@livewireScripts
@endsection
