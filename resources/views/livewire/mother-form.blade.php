@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Name_Mother')}}</label>
                        <input type="text" wire:model="Name_Mother" class="form-control">
                        @error('Name_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.Name_Mother_en')}}</label>
                        <input type="text" wire:model="Name_Mother_en" class="form-control">
                        @error('Name_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.Job_Mother')}}</label>
                        <input type="text" wire:model="Job_Mother" class="form-control">
                        @error('Job_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parents_trans.Job_Mother_en')}}</label>
                        <input type="text" wire:model="Job_Mother_en" class="form-control">
                        @error('Job_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.National_ID_Mother')}}</label>
{{--                        لازم وضروري جدا لما بدي اعمل realtime validation اني اكتب .live مشان يتحقق بالوقت الفعلي--}}
                        <input type="text" wire:model.live="National_ID_Mother" class="form-control">
                        @error('National_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parents_trans.passports_ID_Mother')}}</label>
                        <input type="text" wire:model.live="Passport_ID_Mother" class="form-control">
                        @error('Passport_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parents_trans.Phone_Mother')}}</label>
                        <input type="text" wire:model.live="Phone_Mother" class="form-control">
                        @error('Phone_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parents_trans.Nationality_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Mother_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->nat_name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parents_trans.Blood_Type_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Mother_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->blood_name}}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parents_trans.Religion_Mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Mother_id">
                            <option selected>{{trans('parents_trans.select_from_list')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->rel_name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parents_trans.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="Address_Mother" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('Address_Mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

{{--                يعني لما اكبس على back ارجعلي على رقم 1 لأنو انا عاطيه قيمة 1 فرح يرجع بمتغير قيمتو 1--}}
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('parents_trans.back')}}
                </button>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('Parent_trans.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="secondStepSubmit">{{trans('Parent_trans.Next')}}</button>
                @endif

            </div>
        </div>
    </div>
