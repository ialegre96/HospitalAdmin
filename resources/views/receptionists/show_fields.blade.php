<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{$receptionist->user->image_url}}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{$receptionist->user->full_name}}</a>
                                <span
                                    class="badge badge-light-{{ $receptionist->user->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($receptionist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto: {{$receptionist->user->email}}"
                                   class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                  fill="black"></path>
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{$receptionist->user->email}}
                                </a>
                                <sapn class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    @if(!empty($receptionist->address->address1) || !empty($receptionist->address->address2) || !empty($receptionist->address->city) || !empty($receptionist->address->zip))
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                  fill="black"></path>
                                            <path
                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    {{ !empty($receptionist->address->address1) ? $receptionist->address->address1 : '' }}{{ !empty($receptionist->address->address2) ? !empty($receptionist->address->address1) ? ',' : '' : '' }}
                                    {{ empty($receptionist->address->address1) || !empty($receptionist->address->address2)  ? !empty($receptionist->address->address2) ? $receptionist->address->address2 : '' : '' }}
                                    {{ empty($receptionist->address->address1) && empty($receptionist->address->address2) ? __('messages.common.n/a') : '' }} {{!empty($receptionist->address->city) ? ','.$receptionist->address->city : ''}} {{ !empty($receptionist->address->zip) ? ','.$receptionist->address->zip : '' }}
                                </sapn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#roverview">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#rpayrolls">{{__('messages.my_payrolls')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="roverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Overview</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.phone')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{!empty($receptionist->user->phone)?$receptionist->user->phone:'N/A'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $receptionist->user->gender == 0 ? 'Male' : 'Female' }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.blood_group')  }}</label>
                            <div class="col-lg-8">
                                <span class="fs-6 badge badge-light-{{!empty($receptionist->user->blood_group) ? 'success' : 'danger'}}">{{ !empty($receptionist->user->blood_group) ? $receptionist->user->blood_group : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.dob')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ !empty($receptionist->user->dob) ? \Carbon\Carbon::parse($receptionist->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.designation')  }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($receptionist->user->designation) ? $receptionist->user->designation : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.qualification')  }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($receptionist->user->qualification) ? $receptionist->user->qualification : __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($receptionist->user->created_at) ? $receptionist->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($receptionist->user->updated_at) ? $receptionist->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="rpayrolls" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.my_payrolls')}}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive viewList">
                                    @include('layouts.search-component')
                                    <table id="receptionistPayrolls" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10 text-center">{{ __('messages.employee_payroll.payroll_id') }}</th>
                                            <th class="w-10">{{ __('messages.employee_payroll.month') }}</th>
                                            <th class="w-10">{{ __('messages.employee_payroll.year') }}</th>
                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.basic_salary') }}</th>
                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.allowance') }}</th>
                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.deductions') }}</th>
                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.net_salary') }}</th>
                                            <th class="w-10 text-center">{{ __('messages.common.status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($payrolls as $payroll)
                                            <tr>
                                                <td class="text-center"><a
                                                        href="{{url('employee-payrolls', $payroll->id)}}"><span
                                                            class="badge badge-light-info fs-6">{{ $payroll->payroll_id }}</span></a>
                                                </td>
                                                <td>{{ $payroll->month }}</td>
                                                <td>{{ $payroll->year }}</td>
                                                <td class="text-right">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->basic_salary, 2) }}
                                                </td>
                                                <td class="text-right">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->allowance, 2) }}
                                                </td>
                                                <td class="text-right">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->deductions, 2) }}
                                                </td>
                                                <td class="text-right">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->net_salary, 2) }}
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge fs-6 badge-light-{{($payroll->status == 1) ? 'success' : 'danger'}}">{{ ($payroll->status) ? __('messages.employee_payroll.paid') : __('messages.employee_payroll.not_paid') }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
