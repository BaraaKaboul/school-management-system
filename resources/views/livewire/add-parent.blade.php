<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

        @if ($catchError)
            <div class="alert alert-danger" id="success-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ $catchError }}
            </div>
        @endif


{{--        ازا اتحقق هاد المتغير اعرضلي جدول الاولياء والا اعرضلي الفورم--}}
        @if($show_table)
            @include('livewire.Parent_Table')
        @else
            <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showTable" type="button">{{ trans('Parent_trans.show_table') }}
            </button><br><br>
            <div class="stepwizard">

                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button"
                           class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                        <p>{{ trans('Parent_trans.Step1') }}</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button"
                           class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                        <p>{{ trans('Parent_trans.Step2') }}</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button"
                           class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                           disabled="disabled">3</a>
                        <p>{{ trans('Parent_trans.Step3') }}</p>
                    </div>
                </div>
            </div>


        <div>
{{--        لازم احطن ضمن div مشان مايطلعلي هالخطأ: Livewire only supports one HTML element per component. Multiple root elements detected for component: [add-parent]--}}
    <div>@include('livewire.Father_Form')</div>
    <div>@include('livewire.mother-form')</div>



{{--تمثل تأكيد المعلومات اي الخطوة الثالثة--}}
            <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                @if ($currentStep != 3)
                    <div style="display: none" class="row setup-content" id="step-3">
                        @endif

                        <div class="col-xs-12">
                            <div class="col-md-12"><br>
                                <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>
                                <div class="form-group">
{{--                                    الaccept يعني طلعلي بس الصور لما افتح الملفات--}}
{{--                                    الmultiple يعني اكتر من صورة--}}
                                    <input type="file" wire:model="photos" accept="image/*" multiple>
                                </div>
                                <br>

                                <input type="hidden" wire:model="Parent_id">

                                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                        wire:click="back(2)">{{ trans('parents_trans.back') }}</button>

                                @if($updateMode)
                                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                                            type="button">{{trans('parents_trans.submit')}}
                                    </button>
                                @else
                                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                            type="button">{{ trans('parents_trans.submit') }}</button>
                                @endif

                            </div>
                        </div>
                    </div>

            </div>
        </div>
        @endif
</div>
