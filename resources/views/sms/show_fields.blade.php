<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.sms.sms_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a href="{{route('sms.index')}}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('send_to', __('messages.sms.send_to').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($sms->user && $sms->user->full_name) ? $sms->user->full_name : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('employee_payroll', __('messages.employee_payroll.role').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                 @if(isset($sms->user))
                                        {{$sms->user->roles->pluck('name')->first()}}
                                    @else
                                        {{ __('messages.common.n/a') }}
                                    @endif
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('employee_payroll', __('messages.user.phone').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$sms->phone_number}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('employee_payroll', __('messages.sms.date').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{\Carbon\Carbon::parse($sms->created_at)->format('jS M,Y g:i A')}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('employee_payroll', __('messages.sms.send_by').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$sms->sendBy->full_name}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('employee_payroll', __('messages.sms.message').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">
                                    @if($sms->message)
                                        {!! nl2br(e($sms->message)) !!}
                                    @else
                                        {{ __('messages.common.n/a') }}
                                    @endif
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800" title="{{ date('jS M, Y', strtotime($sms->updated_at)) }}">{{ $sms->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('description', __('messages.item.description').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{!! !empty($sms->description) ? nl2br(e($sms->description)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
