<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.patient_diagnosis_test.patient_diagnosis_test_details') }}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn-sm btn-success me-3" target="_blank"
                           href="{{url('employee/patient-diagnosis-test/'. $patientDiagnosisTest->id.'/pdf')}}">Print
                            Diagnosis Test</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('patient_id', 'Patient'.':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->patient->user->full_name}}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('doctor_id', 'Doctor'.':', ['class' => 'fw-bold text-muted py-3']) }}
                                <sapn
                                    class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->doctor->user->full_name}}</sapn>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('category_id','Diagnosis Category'.':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->category->name}}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('report_number', 'Report Number'.':', ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{$patientDiagnosisTest->report_number}}</span>
                            </div>

                            @if(isset($patientDiagnosisTests))
                                @foreach($patientDiagnosisTests as $patientDiagnosisTest)
                                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                        {{ Form::label($patientDiagnosisTest->property_name, str_replace("_"," ",Str::title($patientDiagnosisTest->property_name)).':', ['class' => 'fw-bold text-muted py-3']) }}
                                        <span
                                            class="fw-bolder fs-6 text-gray-800">{{!empty($patientDiagnosisTest->property_value)?$patientDiagnosisTest->property_value:'N/A'}}</span>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').':',['class'=>'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientDiagnosisTest->created_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $patientDiagnosisTest->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.last_updated').':',['class'=>'fw-bold text-muted py-3']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientDiagnosisTest->updated_at)) }}"
                                      class="fw-bolder fs-6 text-gray-800">{{ $patientDiagnosisTest->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
