@extends('layouts.master')
@section('css')

@endsection
@section('title')
        {{ trans('classes_trans.title_page') }}
@stop
@section('page-header')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('classes_trans.page_header')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{trans('classes_trans.page_header')}}</li>
                </ol>
            </div>
        </div>
    </div>
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
                        {{ trans('classes_trans.add_class') }}
                    </button>

                        <button type="button" class="button x-small" id="btn_delete_all">
                            {{trans('classes_trans.delete_choicen_classes')}}
                        </button>


                    <br><br>

                        <form action="{{ route('class.filter') }}" method="POST">
                            @csrf
                            <select class="selectpicker" data-style="btn-info" name="grade_id" required
                                    onchange="this.form.submit()">
                                <option value="" selected disabled>{{ trans('classes_trans.Search_By_Grade') }}</option>
                                @foreach ($grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                @endforeach
                            </select>
                        </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
{{--                                فائدة هاد الكود انو يعملي checkbox ولما اضغط عليها من فوق بيحددلي على كل السطور دفعة وحدة--}}
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th>#</th>
                                <th>{{ trans('classes_trans.name_class') }}</th>
                                <th>{{ trans('classes_trans.name_Grade') }}</th>
                                <th>{{ trans('classes_trans.processing') }}</th>
                            </tr>
                            </thead>
                            <tbody>

{{--                            طبعا هون حطينا isset($details) بسبب تعليمة withDetails().--}}
                            @if (isset($details))

{{--                                هون لما يكون ال classes الي ضمن foreach بتساوي ال details تبع تعليمة withDetails() اعرضلي البيانات المفلترة--}}
                                    <?php $classes = $details; ?>
                            @else

{{--                                او لما تكون ال classes تبع ال foreach بتساوي ال classes تبع الي موجودة بفنكشن ال index اول شي بالكونترولر اعرضلي كل البيانات--}}
                                    <?php $classes = $classes; ?>
                            @endif

                            @php
                            $i = 0;
                            @endphp
                            @foreach ($classes as $row)
                                <tr>
                                        @php
                                            $i++;
                                        @endphp
                                    <td><input type="checkbox"  value="{{ $row->id }}" class="box1" ></td>
                                    <td>{{$i}}</td>
                                    <td>{{$row->class_name}}</td>
                                    <td>{{$row->grade->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
{{--                                                ونحنا رايحين نفتح الموديل تبعنا اخدنا معنا الid--}}
                                                data-target="#edit{{$row->id}}"
                                                title="{{ trans('grades_trans.edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{$row->id}}"
                                                title="{{ trans('grades_trans.delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
{{--                                ونحنا عم نفتح الموديل تبعنا جبنا معنا الid--}}
                                <div class="modal fade" id="edit{{$row->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('classes_trans.edit_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{ route('classroom.update', 'test') }}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('classes_trans.name_class') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="class_name"
                                                                   class="form-control"
{{--                                                            هون بيفهم انو يجبلي القيمة حسب اللغة المحطوطة--}}
{{--                                                            طبعا بسبب باكدج spatie translatable--}}
                                                                   value="{{$row->getTranslation('class_name','ar')}}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{$row->id}}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('classes_trans.name_class_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$row->getTranslation('class_name','en')}}"
                                                                   name="class_name_en" required>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('classes_trans.name_Grade') }}
                                                            :</label>
                                                        <select class="form-control form-control-lg"
                                                                id="exampleFormControlSelect1" name="grade_id">
                                                            <option value="{{ $row->grade->id }}">
                                                                {{ $row->grade->name }}
                                                            </option>
                                                            @foreach ($grades as $rows)
                                                                <option value="{{ $rows->id }}">
                                                                    {{ $rows->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

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
{{--                                جبنا الid ونحنا جايين نفتح الموديل عن طريق data-target--}}
                                <div class="modal fade" id="delete{{$row->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('classes_trans.delete_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('class.delete') }}"
                                                      method="post">
                                                    @csrf
                                                    {{ trans('classes_trans.warning_class') }} ?
                                                    <input id="id" type="hidden" name="class_id" class="form-control"
                                                           value="{{$row->id}}">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes_trans.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('classroom.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
{{--                                    مشان ياخد بيانات الحقول لرح ينضافو دفعة وحدة منستخدم عالتعليمة data-repeater-list قيمتها هون List_Classes--}}
{{--                                    فينا نستدعيها وتعتبر كمتغير بالكونترولر ونحنا رايحين بالبيانات مشان يحفظن كلن--}}
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('classes_trans.name_class') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('classes_trans.name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name_en" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('classes_trans.name_Grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="grade_id">
                                                            @foreach ($grades as $row)
                                                                <option value="{{$row->id}}">{{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('classes_trans.processing') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button" value="{{ trans('classes_trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>

        <!-- حذف مجموعة صفوف -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes_trans.delete_choicen_classes') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('class.delete_all') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            {{ trans('classes_trans.warning_delete') }}
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('grades_trans.delete') }}</button>
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
{{--    مشان يعمل تحديد على الكل بال checkbox الاساسية--}}
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>


{{--وظيفة هاد الكود انو مابيسمحلي اضغط على "حذف الصفوف المختارة" الا ازا كنت محدد شي صف بال checkbox--}}
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>
@endsection
