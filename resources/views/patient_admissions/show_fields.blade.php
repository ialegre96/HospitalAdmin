<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.patient_admission.details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn-sm btn-primary me-2"
                           href="{{ route('patient-admissions.edit',['patient_admission' => $patientAdmission->id])}}">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.patient').(':')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{$patientAdmission->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.case.doctor').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientAdmission->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.bill.admission_id').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge badge-light-info">{{$patientAdmission->patient_admission_id}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.admission_date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($patientAdmission->admission_date)?date('jS M,Y g:i A', strtotime($patientAdmission->admission_date)):'N/A' }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.discharge_date').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($patientAdmission->discharge_date)?date('jS M, Y g:i A', strtotime($patientAdmission->discharge_date)):'N/A'}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.package').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->package_id))?$patientAdmission->package->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.insurance').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ (!empty($patientAdmission->insurance_id))?$patientAdmission->insurance->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.bed').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->bed_id))?$patientAdmission->bed->name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.policy_no').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->policy_no))?$patientAdmission->policy_no:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.agent_name').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->agent_name))?$patientAdmission->agent_name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.guardian_name').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->guardian_name))?$patientAdmission->guardian_name:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.guardian_relation').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->guardian_relation))?$patientAdmission->guardian_relation:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.guardian_contact').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->guardian_contact))?$patientAdmission->guardian_contact:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_admission.guardian_address').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{(!empty($patientAdmission->guardian_address))?$patientAdmission->guardian_address:__('messages.common.n/a')}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.status').(':')  }}</label>
                                <p class="m-0">
                                    <span class="badge badge-light-{{($patientAdmission->status === 1) ? 'success' : 'danger'}}">{{($patientAdmission->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on').(':')  }}</label>
                                <span data-toggle="tooltip" class="fw-bolder fs-6 text-gray-800" data-placement="right" title="{{ date('jS M, Y', strtotime($patientAdmission->created_at)) }}">{{ $patientAdmission->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($patientAdmission->updated_at)) }}">{{ $patientAdmission->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
