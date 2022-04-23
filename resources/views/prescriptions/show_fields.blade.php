<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{__('messages.prescription.prescription_details')}}</h3>
        </div>
        <div class="d-flex align-items-center py-1">
            <a href="{{ url()->previous() }}"
               class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
        </div>
    </div>
    <div>
        <div class="card-body  border-top p-9">
            <div class="row mb-7">
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('patient_id', __('messages.prescription.patient').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{$prescription->patient->user->full_name}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('doctor_id', __('messages.case.doctor').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{$prescription->doctor->user->full_name}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('food_allergies', __('messages.prescription.food_allergies').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ ($prescription->food_allergies != "") ? $prescription->food_allergies : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('tendency_bleed', __('messages.prescription.tendency_bleed').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->tendency_bleed != "") ? $prescription->tendency_bleed : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('heart_disease', __('messages.prescription.heart_disease').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->heart_disease != "") ? $prescription->heart_disease : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('high_blood_pressure', __('messages.prescription.high_blood_pressure').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->high_blood_pressure != "") ? $prescription->high_blood_pressure : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('diabetic', __('messages.prescription.diabetic').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->diabetic != "") ? $prescription->diabetic : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('surgery', __('messages.prescription.surgery').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->surgery != "") ? $prescription->surgery : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('accident', __('messages.prescription.accident').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->accident != "") ? $prescription->accident : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('others', __('messages.prescription.others').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->others != "") ? $prescription->others : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('medical_history', __('messages.prescription.medical_history').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ ($prescription->medical_history != "") ? $prescription->medical_history : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('current_medication', __('messages.prescription.current_medication').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ ($prescription->current_medication != "") ? $prescription->current_medication : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('female_pregnancy', __('messages.prescription.female_pregnancy').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ ($prescription->female_pregnancy != "") ? $prescription->female_pregnancy : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('breast_feeding', __('messages.prescription.breast_feeding').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->breast_feeding != "") ? $prescription->breast_feeding : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('health_insurance', __('messages.prescription.health_insurance').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->health_insurance != "") ? $prescription->health_insurance : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('low_income', __('messages.prescription.low_income').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->low_income != "") ? $prescription->low_income : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('reference', __('messages.prescription.reference').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{($prescription->reference != "") ? $prescription->reference : __('messages.common.n/a')}}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <p class="m-0">
                        <span
                            class="badge fs-6 badge-light-{{!empty($prescription->status == 1) ? 'success' : 'danger'}}">{{($prescription->status == 1) ? 'Active' : 'Deactive' }}</span>
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('created_on', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                          title="{{ date('jS M, Y', strtotime($prescription->created_at)) }}">{{ $prescription->created_at->diffForHumans() }}</span>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('last_updated', __('messages.common.last_updated').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right"
                          title="{{ date('jS M, Y', strtotime($prescription->updated_at)) }}">{{ $prescription->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
