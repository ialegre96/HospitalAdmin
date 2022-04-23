<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('messages.doctor.doctor_details') }}</h3>
        </div>
        <div class="d-flex align-items-center py-1">
            <a href="{{ url()->previous() }}"
               class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
        </div>
    </div>
    <div>
        <div class="card-body  border-top p-9">
            <div class="row mb-7">
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('doctor', __('messages.case.doctor').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{ $doctor->user->full_name }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('email', __('messages.user.email').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{ $doctor->user->email }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('doctor', __('messages.user.phone').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->user->phone) ? $doctor->user->phone : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{  $doctor->user->designation }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('department', __('messages.appointment.doctor_department').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{  getDoctorDepartment($doctor->doctor_department_id) }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{  $doctor->user->qualification }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->user->blood_group) ? $doctor->user->blood_group : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->user->dob) ? \Carbon\Carbon::parse($doctor->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800">{{ $doctor->user->gender == 0 ? __('messages.user.male') : __('messages.user.female') }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('specialist', __('messages.doctor.specialist').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800">{{ $doctor->specialist }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('status', __('messages.common.status').':', ['class' => 'fw-bold text-muted py-3']) }}
                    <span
                        class="fw-bolder fs-6 text-gray-800"><div class="badge badge-light-{{($doctor->user->status === 1) ? 'success' : 'danger'}}">{{ ($doctor->user->status === 1) ? 'Active' : 'Deactive' }}</div></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800"
                          title="{{ date('jS M, Y', strtotime($doctor->created_at)) }}">{{ $doctor->created_at->diffForHumans() }}</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                    {{ Form::label('updated on', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                    <span class="fw-bolder fs-6 text-gray-800"
                          title="{{ date('jS M, Y', strtotime($doctor->updated_at)) }}">{{ $doctor->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($doctor->address))
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.user.address_details') }}</h3>
            </div>
        </div>
        <div>
            <div class="card-body border-top p-9">
                <div class="row mb-7">
                    <div class="col-md-4 d-flex flex-column">
                        {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->address->address1) ? $doctor->address->address1 : __('messages.common.n/a') }}</span>
                    </div>
                    <div class="col-md-4 d-flex flex-column">
                        {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->address->address2) ? $doctor->address->address2 : __('messages.common.n/a') }}</span>
                    </div>
                    <div class="col-md-2 d-flex flex-column">
                        {{ Form::label('city', __('messages.user.city').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->address->city) ? $doctor->address->city : __('messages.common.n/a') }}</span>
                    </div>
                    <div class="col-md-2 d-flex flex-column">
                        {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'fw-bold text-muted py-3']) }}
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ !empty($doctor->address->zip) ? $doctor->address->zip : __('messages.common.n/a') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
