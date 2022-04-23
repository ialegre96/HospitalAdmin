<div id="AddModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.sms.new_sms') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                </button>
            </div>
            {{ Form::open(['id'=>'addNewForm']) }}
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5 myclass">
                        {{ Form::label('Phone',__('messages.sms.phone_number').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::tel('phone', null, ['class' => 'form-control form-control-solid', 'required','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                        {{ Form::hidden('prefix_code',null,['id'=>'prefix_code']) }}
                        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                        <span id="error-msg" class="hide"></span>
                    </div>
                    <div class="form-group col-sm-6 mb-5 role">
                        {{ Form::label('role', __('messages.sms.role').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('role', $roles, null, ['class' => 'form-select form-select-solid', 'required', 'id'=>'roleId','placeholder' => 'Select Role','data-control'=> 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 d-flex flex-row-reverse mb-5 py-10">
                        <div class="form-check form-check-solid form-switch fv-row">
                            <input name="number" class="form-check-input w-35px h-20px number" value="0"
                                   type="checkbox">
                            <label class="form-check-label" for="allowmarketing"></label>
                            {{ Form::label('number',  __('messages.sms.send_sms_by_number_directly'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        </div>

                        {{--                        <div class="custom-control custom-checkbox ml-2">--}}
                        {{--                            <label class="switch switch-label switch-outline-primary-alt swich-center pt-1">--}}
                        {{--                                <input name="number" class="switch-input number" type="checkbox" value="0">--}}
                        {{--                                <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>--}}
                        {{--                            </label>&nbsp;--}}
                        {{--                            {{ Form::label('number',  __('messages.sms.send_sms_by_number_directly'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="form-group col-sm-12 mb-5 send">
                        {{ Form::label('send_to', __('messages.sms.send_to').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        <span><strong>{{__('messages.sms.only_user_with_registered_phone_will_display')}}</strong></span>
                        {{ Form::select('send_to[]', [null], null, ['class' => 'form-select form-select-solid', 'required', 'id'=>'userId', 'multiple' => true,'disabled', 'data-control'=> 'select2']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('message', __('messages.sms.message').':',['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('message', null, ['class' => 'form-control form-control-solid', 'id' => 'messageId', 'required', 'rows' => 6, 'maxlength'=>"160"]) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


{{--<div id="AddModal" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog">--}}
{{--        <!-- Modal content-->--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">{{__('messages.sms.new_sms')}}</h5>--}}
{{--                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>--}}
{{--            </div>--}}
{{--            {!! Form::open(['id'=>'addNewForm']) !!}--}}
{{--            <div class="modal-body">--}}
{{--                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>--}}
{{--                <div class="row">--}}
{{--                    <div class="form-group col-sm-12 d-flex flex-row-reverse">--}}
{{--                        <div class="custom-control custom-checkbox ml-2">--}}
{{--                            <label class="switch switch-label switch-outline-primary-alt swich-center pt-1">--}}
{{--                                <input name="number" class="switch-input number" type="checkbox" value="0">--}}
{{--                                <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>--}}
{{--                            </label>&nbsp;--}}
{{--                            {{ Form::label('number',  __('messages.sms.send_sms_by_number_directly')) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-sm-12 myclass">--}}
{{--                        {{ Form::label('Phone',__('messages.sms.phone_number').':') }}<span--}}
{{--                                class="required">*</span>--}}
{{--                        {!! Form::tel('phone', null, ['class' => 'form-control', 'required','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}--}}
{{--                        {!! Form::hidden('prefix_code',null,['id'=>'prefix_code']) !!}--}}
{{--                        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>--}}
{{--                        <span id="error-msg" class="hide"></span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-sm-12 role">--}}
{{--                        {{ Form::label('role', __('messages.sms.role').':') }}<span--}}
{{--                                class="required">*</span>--}}
{{--                        {{ Form::select('role', $roles, null, ['class' => 'form-control', 'required', 'id'=>'roleId','placeholder' => 'Select Role']) }}--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-sm-12 send">--}}
{{--                        {{ Form::label('send_to', __('messages.sms.send_to').':') }}<span--}}
{{--                                class="required">* </span><span><strong>{{__('messages.sms.only_user_with_registered_phone_will_display')}}</strong></span>--}}
{{--                        {{ Form::select('send_to[]', [null], null, ['class' => 'form-control', 'required', 'id'=>'userId', 'multiple' => true,'disabled']) }}--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-sm-12">--}}
{{--                        {{ Form::label('message', __('messages.sms.message').':') }}<span--}}
{{--                                class="required">*</span>--}}
{{--                        {!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'messageId', 'required', 'rows' => 6, 'maxlength'=>"160"]) !!}--}}
{{--                    </div>--}}
{{--                    <div class="text-right col-sm-12 mt-4">--}}
{{--                        {!! Form::button( __('messages.sms.send'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Sending..."]) !!}--}}
{{--                        <button type="button" class="btn btn-light ml-1"--}}
{{--                                data-dismiss="modal">{{ __('messages.common.cancel') }}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                {!! Form::close() !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
