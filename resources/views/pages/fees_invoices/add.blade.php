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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class=" row mb-30" action="{{ route('fees-invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Fees">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">اسم الطالب</label>
                                                <select class="fancyselect" name="student_id" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">نوع الرسوم</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id" required>
                                                        <option value="">-- اختار من القائمة --</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">المبلغ</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="amount" required>
                                                        <option value="">-- اختار من القائمة --</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description" class="mr-sm-2">البيان</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description" required>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                    </div>
                                </div><br>
                                <input type="hidden" name="Grade_id" value="{{$student->Grade_id}}">
                                <input type="hidden" name="Classroom_id" value="{{$student->Classroom_id}}">

                                <button type="submit" class="btn btn-primary">تاكيد البيانات</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('select[name="fee_id"]').on('change', function () {--}}
{{--                var Grade_id = $(this).val();--}}
{{--                if (Grade_id) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ URL::to('Get_amount') }}/" + Grade_id,--}}
{{--                        type: "GET",--}}
{{--                        dataType: "json",--}}
{{--                        success: function (data) {--}}
{{--                            $('select[name="amount"]').empty();--}}
{{--                            $('select[name="amount"]').append('<option selected disabled >{{trans('student_trans.Choose')}}...</option>');--}}
{{--                            $.each(data, function (key, value) {--}}
{{--                                $('select[name="amount"]').append('<option value="' + key + '">' + value + '</option>');--}}
{{--                            });--}}

{{--                        },--}}
{{--                    });--}}
{{--                }--}}

{{--                else {--}}
{{--                    console.log('AJAX load did not work');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
