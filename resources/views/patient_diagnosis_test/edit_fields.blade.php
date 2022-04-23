<div class="row gx-10 mb-5">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('patient_id', __('messages.patient_diagnosis_test.patient').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('patient_id', $patients, isset($patientDiagnosisTest)?$patientDiagnosisTest->patient_id:null, ['class' => 'form-select form-select-solid', 'required', 'id' => 'patient_id', 'placeholder' => 'Select Patient', 'data-control' => 'select2']) }}
        </div>
    </div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-md-3">
            {{ Form::label('doctor_id', __('messages.patient_diagnosis_test.doctor').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('doctor_id', $doctors, isset($patientDiagnosisTest)?$patientDiagnosisTest->doctor_id:null, ['class' => 'form-select form-select-solid','required','id' => 'doctor_id','placeholder'=>'Select Doctor', 'data-control' => 'select2']) }}
        </div>
    @endif
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('category_id', __('messages.patient_diagnosis_test.diagnosis_category').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::select('category_id', $diagnosisCategory, isset($patientDiagnosisTest)?$patientDiagnosisTest->category_id:null, ['class' => 'form-select form-select-solid', 'required', 'id' => 'category_id', 'data-control' => 'select2', 'placeholder' => 'Select Diagnosis Category']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('report_number', __('messages.patient_diagnosis_test.report_number').':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('report_number', isset($patientDiagnosisTest)?$patientDiagnosisTest->report_number:$reportNumber, ['class' => 'form-control form-control-solid', 'readonly']) }}
        </div>
    </div>

    @if(isset($patientDiagnosisTests))
        @foreach($patientDiagnosisTests as $patientDiagnosisTest)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group mb-5">
                    {{ Form::label($patientDiagnosisTest->property_name, str_replace("_"," ",Str::title($patientDiagnosisTest->property_name)) .':', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    @if($patientDiagnosisTest->property_name == 'height')
                        {{ Form::number($patientDiagnosisTest->property_name, $patientDiagnosisTest->property_value, ['class' => 'form-control floatNumber form-control-solid', 'max' => '7', 'min' => '1' , 'step' => '.01']) }}
                    @elseif($patientDiagnosisTest->property_name == 'weight')
                        {{ Form::number($patientDiagnosisTest->property_name, $patientDiagnosisTest->property_value, ['class' => 'form-control form-control-solid', 'max' => '200', 'min' => '1' , 'step' => '.01', 'data-mask'=>'##0,00']) }}
                    @elseif($patientDiagnosisTest->property_name == 'age')
                        {{ Form::text($patientDiagnosisTest->property_name, $patientDiagnosisTest->property_value, ['class' => 'form-control form-control-solid','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    @else
                        {{ Form::text($patientDiagnosisTest->property_name, $patientDiagnosisTest->property_value, ['class' => 'form-control form-control-solid']) }}
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-sm-12 mt-3">
        <div class="mb-3 h5">
            {{__('messages.patient_diagnosis_test.add_other_diagnosis_property')}}
        </div>
        <table class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100" id="patientDiagnosisTestTbl">
            <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="text-center">#</th>
                <th class="diagnoses-filed">{{__('messages.patient_diagnosis_test.diagnosis_property_name')}}
                </th>
                <th class="diagnoses-filed">{{__('messages.patient_diagnosis_test.diagnosis_property_value')}}
                </th>
                <th>
                    <button type="button" class="btn btn-sm btn-primary float-right w-50"
                            id="addItem">{{ __('messages.common.add') }}</button>
                </th>
            </tr>
            </thead>
            <tbody class="diagnosis-item-container text-gray-600 fw-bold">
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'saveBtn']) }}
    <a href="{{ route('patient.diagnosis.test.index') }}"
       class="btn btn-light btn-active-light-primary me-2">{{ __('messages.common.cancel') }}</a>
</div>
