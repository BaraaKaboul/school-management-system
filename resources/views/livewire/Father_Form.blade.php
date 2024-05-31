@if($currentStep != 1)
{{--    يعني لما ما اكون ب1 اخفيلي محتوياتا--}}
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
{{--                        لازم وضروري جدا لما بدي اعمل realtime validation اني اكتب .live مشان يتحقق بالوقت الفعلي--}}
                        <label for="title">{{trans('parents_trans.email')}}</label>
                        <input type="email" wire:model.live="Email"  class="form-control">
                        @error('Email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.password')}}</label>
                        <input type="password" wire:model="Password" class="form-control" >
                        @error('Password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents_trans.name_father_ar')}}</label>
                        <input type="text" wire:model="Name_Father" class="form-control" >
                        @error('Name_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.name_father_en')}}</label>
                        <input type="text" wire:model="Name_Father_en" class="form-control" >
                        @error('Name_Father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.name_job_ar')}}</label>
                        <input type="text" wire:model="Job_Father" class="form-control">
                        @error('Job_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.name_job_en')}}</label>
                        <input type="text" wire:model="Job_Father_en" class="form-control">
                        @error('Job_Father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.ID_number')}}</label>
                        <input type="text" wire:model.live="National_ID_Father" class="form-control">
                        @error('National_ID_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.passport_number')}}</label>
                        <input type="text" wire:model.live="Passport_ID_Father" class="form-control">
                        @error('Passport_ID_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.phone_number')}}</label>
                        <input type="text" wire:model.live="Phone_Father" class="form-control">
                        @error('Phone_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents_trans.nationality')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->nat_name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents_trans.blood_type')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->blood_name}}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parents_trans.regligion')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->rel_name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parents_trans.father_address')}}</label>
                    <textarea class="form-control" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('Address_Father')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
                            type="button">{{trans('parents_trans.next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                            type="button">{{trans('parents_trans.next')}}
                    </button>
                @endif

            </div>
        </div>
    </div>
