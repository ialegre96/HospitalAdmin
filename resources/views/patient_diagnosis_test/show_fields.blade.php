<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.patient_diagnosis_test.patient_diagnosis_test_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{route('patient.diagnosis.test.pdf',['patientDiagnosisTest' => $patientDiagnosisTest->id])}}"
                           class="btn btn-sm btn-success me-2 edit-btn">{{ __('messages.patient_diagnosis_test.print_diagnosis_test') }}</a>
                        <a href="{{route('patient.diagnosis.test.edit',['patientDiagnosisTest' => $patientDiagnosisTest->id])}}"
                           class="btn btn-sm btn-primary me-2 edit-btn">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url('patient-diagnosis-test')}}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.patient')  }}</label>
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.doctor')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->doctor->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.diagnosis_category')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->category->name}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.report_number')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->report_number}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.report_number')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->report_number}}</span>
                            </div>
                            @if(isset($patientDiagnosisTests))
                                @foreach($patientDiagnosisTests as $patientDiagnosisTest)
                                    <div class="col-lg-4 d-flex flex-column">
                                        @if(Lang::has('messages.patient_diagnosis_test.'.$patientDiagnosisTest->property_name.''))
                                            <label class="fw-bold text-muted py-3">{{ __('messages.patient_diagnosis_test.'.$patientDiagnosisTest->property_name.'')  }}</label>
                                        @else
                                            <label class="fw-bold text-muted py-3">{{ str_replace("_"," ",$patientDiagnosisTest->property_name) }}</label>
                                        @endif
                                        <span class="fw-bolder fs-6 text-gray-800">{{!empty($patientDiagnosisTest->property_value)?$patientDiagnosisTest->property_value:'N/A'}}</span>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($patientDiagnosisTest->created_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($patientDiagnosisTest->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($patientDiagnosisTest->updated_at)->format('jS M, Y') }}">{{ \Carbon\Carbon::parse($patientDiagnosisTest->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
