<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.employee_payroll.employee_payroll_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        @if (!Auth::user()->hasRole('Doctor|Case Manager|Lab Technician|Nurse|Pharmacist|Receptionist'))
                            <a href="{{ route('employee-payrolls.edit',['employeePayroll' => $employeePayroll->id]) }}"
                               class="btn btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                        @endif
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('sr no', __('messages.employee_payroll.sr_no').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->sr_no}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('payroll id', __('messages.employee_payroll.payroll_id').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->payroll_id}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('payroll role', __('messages.employee_payroll.role').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->type_string}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('full name', __('messages.employee_payroll.employee').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->owner->user->full_name}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('month', __('messages.employee_payroll.month').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->month}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('year', __('messages.employee_payroll.year').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{$employeePayroll->year}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <p class="m-0"><span
                                        class="badge badge-light-{{$employeePayroll->status == 0 ? 'danger' : 'success'}}">{{ ($employeePayroll->status == 0) ? 'Unpaid' : 'Paid' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('salary', __('messages.employee_payroll.basic_salary').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800"> {{ number_format($employeePayroll->basic_salary, 2) }}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('allowance', __('messages.employee_payroll.allowance').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ number_format($employeePayroll->allowance, 2) }}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('deductions', __('messages.employee_payroll.deductions').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ number_format($employeePayroll->deductions, 2)}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('net salary', __('messages.employee_payroll.net_salary').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ number_format($employeePayroll->net_salary, 2)}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $employeePayroll->created_at->diffForHumans()}}</span>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                                {{ Form::label('updated at', __('messages.common.updated_at').(':'), ['class' => 'fw-bold text-muted py-3']) }}
                                <span class="fw-bolder fs-6 text-gray-800">{{ $employeePayroll->updated_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
