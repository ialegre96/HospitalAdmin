<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.patient_admission.details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('patient_id', __('messages.case.patient').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $patientAdmission->patient->user->full_name }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('doctor_id', __('messages.case.doctor').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $patientAdmission->doctor->user->full_name }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('admission_id', __('messages.bill.admission_id').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <sapn
                                    class="fw-bolder fs-6 text-gray-800">{{ $patientAdmission->patient_admission_id }}</sapn>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('admission_date', __('messages.patient_admission.admission_date').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($patientAdmission->admission_date)->format('jS M, Y g:i A') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('discharge_date', __('messages.patient_admission.discharge_date').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($patientAdmission->discharge_date)):'N/A' }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('package_id', __('messages.patient_admission.package').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->package_id))?$patientAdmission->package->name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('insurance_id', __('messages.patient_admission.insurance').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <sapn
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->insurance_id))?$patientAdmission->insurance->name:__('messages.common.n/a') }}</sapn>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('bed_id', __('messages.patient_admission.bed').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->bed_id))?$patientAdmission->bed->name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('policy_no', __('messages.patient_admission.policy_no').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->policy_no))?$patientAdmission->policy_no:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('agent_name', __('messages.patient_admission.agent_name').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->agent_name))?$patientAdmission->agent_name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('guardian_name', __('messages.patient_admission.guardian_name').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->guardian_name))?$patientAdmission->guardian_name:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('guardian_relation', __('messages.patient_admission.guardian_relation').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->guardian_relation))?$patientAdmission->guardian_relation:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('guardian_contact', __('messages.patient_admission.guardian_contact').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->guardian_contact))?$patientAdmission->guardian_contact:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('guardian_address', __('messages.patient_admission.guardian_address').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->guardian_address))?$patientAdmission->guardian_address:__('messages.common.n/a') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('status', __('messages.common.status').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ ($patientAdmission->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientAdmission->created_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $patientAdmission->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.last_updated').':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientAdmission->updated_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $patientAdmission->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
