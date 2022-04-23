<div id="addConsultantInstructionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_consultant_register.new_consultant_register') }}</h2>
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
            {{ Form::open(['id'=>'addIpdConsultantNewForm']) }}
            <div class="modal-body ipdConsultantModel scroll-y mx-5 my-7 model-lg">
                <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="col-sm-12 md-overflow-auto">
                        <div class="table-responsive mb-10">
                        <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700"
                               id="ipdConsultantInstructionTbl">
                            <thead class="consultant-table-theme">
                            <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                <th class="min-w-50px w-50px text-center">#</th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.applied_date') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.doctor_id') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.instruction_date') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.instruction') }}
                                    <span class="required"></span></th>
                                <th class="min-w-75px w-75px text-end">
                                    <button type="button" class="btn btn-sm btn-primary w-100"
                                            id="addItem">{{ __('messages.common.add') }}</button>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="ipd-consultant-item-container">
                            <tr>
                                <td class="text-center item-number consultant-table-td">1</td>
                                <td class="consultant-table-td position-relative">
                                    {{ Form::text('applied_date[]', null, ['class' => 'form-control form-control-solid appliedDate min-w-170', 'autocomplete' => 'off', 'required']) }}
                                </td>
                                <td class="consultant-table-td">
                                    {{ Form::select('doctor_id[]', $doctors, null, ['class' => 'form-select form-select-solid doctorId select2Selector','required','placeholder'=>'Select Doctor']) }}
                                </td>
                                <td class="consultant-table-td position-relative">
                                    {{ Form::text('instruction_date[]', null, ['class' => 'form-control form-control-solid instructionDate min-w-170', 'autocomplete' => 'off', 'required']) }}
                                </td>
                                <td class="consultant-table-td">
                                    {{ Form::textarea('instruction[]', null, ['class' => 'form-control form-control-solid min-w-170', 'onkeypress' => 'return avoidSpace(event);', 'rows' => 1, 'required']) }}
                                </td>
                                <td class="text-center consultant-table-td">
                                    <i class="fa fa-trash text-danger deleteIpdConsultantInstruction pointer"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnIpdConsultantSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
