<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.patients_case_details') }}</h3>
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
                        {{ Form::label('case_id', __('messages.case.case_id').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span class="fw-bolder fs-6 text-gray-800">{{ $patientCase->case_id }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('patient_name', __('messages.case.patient').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span class="fw-bolder fs-6 text-gray-800">{{ $patientCase->patient->user->full_name }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('phone', __('messages.case.phone').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ !empty($patientCase->phone)?$patientCase->phone:'N/A' }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('doctor_name', __('messages.case.doctor').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span class="fw-bolder fs-6 text-gray-800">{{ $patientCase->doctor->user->full_name }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('date', __('messages.case.case_date').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($patientCase->date)->format('jS M,Y g:i A') }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('status', __('messages.common.status').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <p class="m-0"><span
                                class="badge fs-6 badge-light-{{($patientCase->status === 1) ? 'success' : 'danger'}}">{{($patientCase->status === 1) ? __('messages.common.active') : __('messages.common.de_active')}}</span>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('fee', __('messages.case.fee').':',['class'=>'fw-bold text-muted py-3']) }}
                        <span class="fw-bolder fs-6 text-gray-800"><b>{{ getCurrencySymbol() }}</b> {{ number_format($patientCase->fee,2) }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span data-toggle="tooltip" data-placement="right"
                              title="{{ date('jS M, Y', strtotime($patientCase->created_at)) }}"
                              class="fw-bolder fs-6 text-gray-800">{{ $patientCase->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                        {{ Form::label('updated_at', __('messages.common.last_updated').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span data-toggle="tooltip" data-placement="right"
                              title="{{ date('jS M, Y', strtotime($patientCase->updated_at)) }}"
                              class="fw-bolder fs-6 text-gray-800">{{ $patientCase->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column">
                        {{ Form::label('description', __('messages.case.description').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{!! !empty($patientCase->description)? nl2br(e($patientCase->description)): 'N/A' !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
