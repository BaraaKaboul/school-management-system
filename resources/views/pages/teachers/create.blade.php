@extends('layouts.master')
@section('css')

@endsection
@section('title')
{{trans('teachers_trans.add_title')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{trans('teachers_trans.add_title')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{trans('teachers_trans.add_title')}}</li>
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
                            <form action="{{route('teachers.store')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers_trans.Email')}}</label>
                                        <input type="email" name="email" class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers_trans.Password')}}</label>
                                        <input type="password" name="password" class="form-control">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers_trans.Name_ar')}}</label>
                                        <input type="text" name="Name_ar" class="form-control">
                                        @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers_trans.Name_en')}}</label>
                                        <input type="text" name="Name_en" class="form-control">
                                        @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('teachers_trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                            <option selected disabled>{{trans('teachers_trans.Choose')}}...</option>
                                            @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('teachers_trans.Gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                            <option selected disabled>{{trans('teachers_trans.Choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}">{{$gender->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers_trans.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('teachers_trans.Address')}}</label>
                                    <textarea class="form-control" name="Address"
                                              id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('teachers_trans.submit')}}</button>
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
