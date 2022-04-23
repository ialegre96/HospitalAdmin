<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.bed_assign.bed_assign_details')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('patient', __('messages.case.patient').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$bedAssign->patient->user->full_name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('bed_assign', __('messages.bed_assign.bed').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $bedAssign->bed->name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('case_id', __('messages.bed_assign.case_id').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0"><span class="badge badge-light-info fs-6">{{$bedAssign->case_id}}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('ipd_patient_id', __('messages.bed_assign.ipd_patient_id').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span class="badge badge-light-info fs-6">{{ ($bedAssign->ipdPatient != null) ? $bedAssign->ipdPatient->ipd_number : __('messages.common.n/a') }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('assign_date', __('messages.bed_assign.assign_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{!empty($bedAssign->assign_date)?date('jS M, Y h:i A', strtotime($bedAssign->assign_date)):'N/A'}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('discharge_date', __('messages.bed_assign.discharge_date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{!empty($bedAssign->discharge_date)?date('jS M, Y h:i A', strtotime($bedAssign->discharge_date)):'N/A'}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0">
                                    <span
                                        class="badge fs-6 badge-light-{{!empty(($bedAssign->status === 1)) ? 'success' : 'danger'}}">{{ ($bedAssign->status === 1) ? 'Active' : 'Deactive' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800"
                                      title="{{ date('jS M, Y', strtotime($bedAssign->created_at)) }}">{{ $bedAssign->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($bedAssign->updated_at)) }}">{{ $bedAssign->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 d-flex flex-column">
                                {{ Form::label('description', __('messages.bed_assign.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($bedAssign->description)?nl2br(e($bedAssign->description)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
