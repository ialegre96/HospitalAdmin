<div id="addModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.vaccinated_patient.new_vaccinate_patient') }}</h2>
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
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.vaccinated_patient.patient').(':'), ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select form-select-solid fw-bold', 'id' => 'patientName','data-control' => 'select2','placeholder' => 'Select Patient', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('vaccination_id', __('messages.vaccinated_patient.vaccine').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::select('vaccination_id', $vaccinations, null, ['class' => 'form-select form-select-solid fw-bold', 'id' => 'vaccinationName','placeholder' => 'Select Vaccination', 'required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('vaccination_serial_number', __('messages.vaccinated_patient.serial_no').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('vaccination_serial_number', '', ['id'=>'serialNo','class' => 'form-control form-control-solid']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('dose_number', __('messages.vaccinated_patient.does_no').(':'),['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::number('dose_number', '', ['id'=>'brand','class' => 'form-control form-control-solid','min'=>'1','max'=>'50','minlength'=>'1','maxlength'=>'2','required']) }}
                    </div>
                    @php $currentLang = app()->getLocale() @endphp
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('dose_given_date', __('messages.vaccinated_patient.dose_given_date').(':'),['class' => $currentLang == 'es' ? 'label-display form-label required fs-6 fw-bolder text-gray-700 mb-3' : 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::text('dose_given_date', '', ['id'=>'doesGivenDate','class' => 'form-control form-control-solid','required','autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.document.notes').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
