@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{trans('grades_trans.grades')}}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main-sidebar_trans.grades_list')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('grades_trans.grades_list')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('grades_trans.add_grade') }}
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('grades_trans.grade_name')}}</th>
                            <th>{{trans('grades_trans.notes')}}</th>
                            <th>{{trans('grades_trans.processes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($grades as $row)
                            @php
                                $i++;
                            @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->note}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        {{--                                        هون لانو عم نستخدم modal فلازم ونحنا رايحين لعندو ناخد معنا الid--}}
                                        {{--    طبعا بسبب data-target هي لبتفتحلي وبتروح لعند الmodal --}}
                                        data-target="#edit{{ $row->id }}"
                                        title="{{trans('grades_trans.edit')}}"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
{{--                                        هون لانو عم نستخدم modal فلازم ونحنا رايحين لعندو ناخد معنا الid--}}
{{--    طبعا بسبب data-target هي لبتفتحلي وبتروح لعند الmodal --}}
                                        data-target="#delete{{ $row->id }}"
                                        title="{{trans('grades_trans.delete')}}"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                            <!-- edit_modal_Grade -->
                            {{--                            وهون مشان نفتحفو لل modal حسب تسماية data-target فمنفتحو ونحنا معانا ال id--}}
                            <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('grades_trans.edit_grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('grade.update', 'test')}}" method="post">
                                                @method('put')
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                               class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="name"
                                                               class="form-control"
{{--                                                               هون لانو مستخدمين بكج spatie translatable فاستخدمنا الفانكشن هاد مشان يجبلي الحقل الي ساوينالو ترجمة ويجبلي الترجمة تبعو--}}
                                                               value="{{ $row->getTranslation('name', 'ar') }}"
                                                               required>
{{--                                                        معنا هاد الانبوت المخفي مشان نستخدمو بالكونترولر--}}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $row->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
{{--                                                               هون لانو مستخدمين بكج spatie translatable فاستخدمنا الفانكشن هاد مشان يجبلي الحقل الي ساوينالو ترجمة ويجبلي الترجمة تبعو--}}
                                                               value="{{ $row->getTranslation('name', 'en') }}"
                                                               name="name_en" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('grades_trans.notes') }}
                                                        :</label>
                                                    <textarea class="form-control" name="note"
                                                              id="exampleFormControlTextarea1"
                                                              rows="3">{{ $row->note }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('grades_trans.edit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_Grade -->
{{--                            وهون مشان نفتحفو لل modal حسب تسماية data-target فمنفتحو ونحنا معانا ال id--}}
                            <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('grades_trans.delete_grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('grade.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('grades_trans.warning_grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $row->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('grades_trans.delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('grades_trans.add_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{route('grade.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('grades_trans.notes') }}
                                :</label>
                            <textarea class="form-control" name="note" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                        </div>
                        <br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div><!-- row closed -->
@endsection
@section('js')

@endsection
