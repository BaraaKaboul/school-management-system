@extends('layouts.master')
@section('css')

@endsection
@section('title')
{{trans('sections_trans.title')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{trans('sections_trans.title')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{trans('sections_trans.title')}}</li>
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
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('sections_trans.add_section') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grades as $grade)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('sections_trans.section_name') }}
                                                                    </th>
                                                                    <th>{{ trans('sections_trans.class_name') }}</th>
                                                                    <th>{{ trans('sections_trans.status') }}</th>
                                                                    <th>{{ trans('sections_trans.processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0; ?>
                                                                @foreach ($grade->section as $list_sections)
                                                                    <tr>
                                                                            <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $list_sections->section_name }}</td>
                                                                        <td>{{ $list_sections->classroom->class_name }}</td>
                                                                        <td>
                                                                            @if ($list_sections->status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('sections_trans.status_section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('sections_trans.status_section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                               class="btn btn-outline-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#edit{{$list_sections->id}}">{{ trans('sections_trans.edit') }}</a>
                                                                            <a href="#"
                                                                               class="btn btn-outline-danger btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#delete{{$list_sections->id}}">{{ trans('sections_trans.delete') }}</a>
                                                                        </td>
                                                                    </tr>

                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade"
{{--                                                                         بسبب الزر تبع التعديل فوق جبنا معا ال id معنا ونحنا جايين نفتح الموديل بسبب data-target--}}
                                                                         id="edit{{$list_sections->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('sections_trans.edit_section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form
                                                                                        action="{{ route('section.update', 'test') }}"
                                                                                        method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_Section_Ar"
                                                                                                       class="form-control"
                                                                                                       value="{{$list_sections->getTranslation('section_name','ar')}}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_Section_En"
                                                                                                       class="form-control"
                                                                                                       value="{{$list_sections->getTranslation('section_name','en')}}">
                                                                                                <input id="id"
                                                                                                       type="hidden"
                                                                                                       name="id"
                                                                                                       class="form-control"
                                                                                                       value="{{$list_sections->id}}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('sections_trans.grade_name') }}</label>
                                                                                            <select name="Grade_id"
                                                                                                    class="custom-select"
                                                                                                    onclick="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $grade->id }}">
                                                                                                    {{ $grade->name }}
                                                                                                </option>
                                                                                                @foreach ($grades as $list_Grade)
                                                                                                    <option
                                                                                                        value="{{ $list_Grade->id }}">
                                                                                                        {{ $list_Grade->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('sections_trans.class_name') }}</label>
                                                                                            <select name="Class_id"
                                                                                                    class="custom-select">
                                                                                                <option
                                                                                                    value="{{$list_sections->classroom->id}}">
                                                                                                    {{$list_sections->classroom->class_name}}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                @if ($list_sections->status === 1)
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        checked
                                                                                                        class="form-check-input"
                                                                                                        name="status"
                                                                                                        id="exampleCheck1">
                                                                                                @else
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        name="status"
                                                                                                        id="exampleCheck1">
                                                                                                @endif
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleCheck1">{{ trans('sections_trans.status') }}</label><br>

                                                                                                    <div class="col">
                                                                                                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
{{--                                                                                                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">--}}
{{--                                                                                                            @foreach($list_sections->teacher as $teacher)--}}
{{--                                                                                                                <option selected value="{{$teacher['id']}}">{{$teacher['Name']}}</option>--}}
{{--                                                                                                            @endforeach--}}

{{--                                                                                                            @foreach($teachers as $teacher)--}}
{{--                                                                                                                <option value="{{$teacher->id}}">{{$teacher->Name}}</option>--}}
{{--                                                                                                            @endforeach--}}
{{--                                                                                                        </select>--}}
                                                                                                        <select multiple name="teacher_id[]" class="form-control" id="teacher_id">
                                                                                                            @foreach($teachers as $teacher)
                                                                                                                <option value="{{$teacher->id}}" @if($list_sections->teacher->contains($teacher->id)) selected @endif>{{$teacher->Name}}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>

                                                                                            </div>
                                                                                        </div>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-info">{{ trans('sections_trans.edit') }}</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- delete_modal_Grade -->
                                                                    <div class="modal fade"
{{--                                                                         بسبب الزر تبع الحذف فوق جبنا معا ال id معنا ونحنا جايين نفتح الموديل بسبب data-target--}}
                                                                         id="delete{{$list_sections->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('sections_trans.delete_section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('section.destroy', 'test') }}"
                                                                                        method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('sections_trans.warning_delete_section') }}
                                                                                        <input id="id" type="hidden"
                                                                                               name="id"
                                                                                               class="form-control"
                                                                                               value="{{$list_sections->id}}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger">{{ trans('sections_trans.delete') }}</button>
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
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <!--اضافة قسم جديد -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('sections_trans.add_section') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('section.store', 'test') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="Name_Section_Ar" class="form-control"
                                                       placeholder="{{ trans('sections_trans.section_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="Name_Section_En" class="form-control"
                                                       placeholder="{{ trans('sections_trans.section_name_en') }}">
                                            </div>

                                        </div>
                                        <br>


                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections_trans.grade_name') }}</label>
{{--                                            //الname هون مربوطة ايضا مع كود الجافاسكربت تحت--}}
                                            <select name="Grade_id" class="custom-select"
                                                    onchange="console.log($(this).val())">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('sections_trans.grade_select') }}
                                                </option>
                                                @foreach ($grades as $list_Grade)
                                                    <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('sections_trans.class_name') }}</label>
{{--                                            الname مربوطة بكود الجافاسكربت تحت--}}
                                            <select name="Class_id" class="custom-select">

                                            </select>
                                        </div><br>

                                        <div class="col">
                                            <label for="inputName" class="control-label">{{ trans('teachers_trans.Name_Teacher') }}</label>
{{--                                            حطينا قوسين الاarray لانو ممكن يكون لصف معين اكتر من استاذ--}}
                                            <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('sections_trans.close') }}</button>
                                    <button type="submit"
                                            class="btn btn-success">{{ trans('sections_trans.add_section') }}</button>
                                </div>
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
{{--    وظيفة هاد الكود انو بيجبلي الclasses بناءا على الgrade المختارة بالاضافة--}}
{{--        ومربوطة براوت اسمو getClasses من راوتات section--}}
            <script>
                $(document).ready(function () {
                    $('select[name="Grade_id"]').on('change', function () {
                        var Grade_id = $(this).val();
                        if (Grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + Grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="Class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>
@endsection
