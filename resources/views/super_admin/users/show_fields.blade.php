<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{$users['hospital']->image_url}}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $users['hospital']->full_name }}</a>
                                <span
                                        class="badge badge-light-{{  $users['hospital']->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($users['hospital']->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto:{{ $users['hospital']->email }}"
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
                                    {{ $users['hospital']->email }}
                                </a>
                            </div>
                        </div>
                        {{--                        <div class="d-flex col-12">--}}
                        {{--                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                        {{--                                <div class="d-flex align-items-center"><i--}}
                        {{--                                        class="fas fa-book-medical fa-2x me-2 text-black"></i>--}}
                        {{--                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"--}}
                        {{--                                         data-kt-countup-value="{{!empty($users['hospital']->cases) ? $users['hospital']->cases->count() : ''}}">--}}
                        {{--                                        0--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_cases')}}</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                        {{--                                <div class="d-flex align-items-center"><i class="fas fa-calendar-alt fa-2x me-2 text-warning"></i>--}}
                        {{--                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true" data-kt-countup-value="{{!empty($users['hospital']->patients) ? $users['hospital']->patients->count() : ''}}">--}}
                        {{--                                        0--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patients')}}</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">--}}
                        {{--                                <div class="d-flex align-items-center"><i class="fas fa-calendar-check fa-2x me-2 text-info"></i>--}}
                        {{--                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true" data-kt-countup-value="{{!empty($users['hospital']->appointments) ? $users['hospital']->appointments->count() : ''}}">--}}
                        {{--                                        0--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_appointments')}}</div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab"
                           href="#poverview">{{ __('messages.overview') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#husers">{{ __('messages.users') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#hBillings">{{ __('messages.billings') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#hTransaction">{{ __('messages.subscription_plans.transactions') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.overview') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.hospitals_list.hospital_name') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">
                                    {{ $users['hospital']->hospital->hospital_name }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.hospital_slug') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <a href="{{route('front', $users['hospital']->username)}}" class="show-btn text-blue"
                                   target="_blank">{{$users['hospital']->username}}
                                    <span class="ms-1"><i class="fas fa-external-link-alt url-external-link"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.email') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{!empty($users['hospital']->email)?($users['hospital']->email):__('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.employee_payroll.role') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{!empty($users['hospital']->roles[0]->name)?($users['hospital']->roles[0]->name):__('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.phone') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{!empty($users['hospital']->phone)?($users['hospital']->phone):__('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($users['hospital']->created_at) ? $users['hospital']->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($users['hospital']->updated_at) ? $users['hospital']->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="husers" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.users') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9 pt-6">
                        <div class="card-header border-0 px-0">
                            @include('layouts.search-component')
                            <div class="card-toolbar">
                                <div class="d-flex align-items-center py-1">
                                    <div class="ms-auto">
                                        <a href="#" class="btn btn-flex btn-light-primary fw-bolder"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                           data-kt-menu-flip="top-end">
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                                d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                                fill="#000000"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            {{ __('messages.common.filter') }}</a>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_6113c71822d0d">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">{{ __('messages.common.filter_options') }}</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">{{ __('messages.common.status').':' }}</label>
                                                    {{ Form::select('status', ['' => 'All'] +$users['statusArr'],null, ['id' => 'statusArr', 'data-control' =>'select2', 'class' => 'form-select form-select-solid status-selector select2-hidden-accessible data-allow-clear="true"']) }}
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">{{ __('messages.employee_payroll.role').':' }}</label>
                                                    {{ Form::select('department_id', ['' => 'Select Role']+$users['roles'],null, ['id' => 'roleArr', 'data-control' =>'select2', 'class' => 'form-select form-select-solid role-selector',]) }}
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                            class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                            id="resetFilter"
                                                            data-kt-menu-dismiss="true">{{ __('messages.common.reset') }}</button>
                                                </div>
                                                <input type="hidden" name="hospitalId" id="hospitalId"
                                                       value="{{$users['hospital']->id}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive viewList">
                                    <table id="hospitalUser"
                                           class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.users')}}</th>
                                            <th>{{__('messages.employee_payroll.role')}}</th>
                                            <th>{{ __('messages.user.email') }}</th>
                                            <th>{{ __('messages.user.phone') }}</th>
                                            <th>{{ __('messages.common.status') }}</th>
                                            <th>{{ __('messages.common.created_at') }}</th>
                                            <th>{{__('messages.impersonate')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="hBillings" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.billings') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9 pt-6">
                        <div class="card-header border-0 px-0">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                          fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                          fill="#000000" fill-rule="nonzero"/>
                </g>
            </svg>
        </span>
                                    <input type="text" data-datatable-filter="search" id="search-table-billing"
                                           name="search"
                                           class="form-control form-control-solid w-250px ps-14" placeholder="Search"/>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex align-items-center py-1">
                                    <div class="ms-auto">
                                        <a href="#" class="btn btn-flex btn-light-primary fw-bolder"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                           data-kt-menu-flip="top-end">
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                                d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                                fill="#000000"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            {{ __('messages.common.filter') }}</a>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_6113c71822d0d">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">{{ __('messages.common.filter_options') }}</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">{{ __('messages.common.status').':' }}</label>
                                                    {{ Form::select('status', ['' => 'All'] +$users['statusArr'],null, ['id' => 'billingStatusArr', 'data-control' =>'select2', 'class' => 'form-select form-select-solid status-selector select2-hidden-accessible data-allow-clear="true"']) }}
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">{{ __('messages.subscription_plans.payment_type').':' }}</label>
                                                    {{ Form::select('status', ['' => 'All'] +$users['paymentType'],null, ['id' => 'billingPaymentType', 'data-control' =>'select2', 'class' => 'form-select form-select-solid status-selector select2-hidden-accessible data-allow-clear="true"']) }}
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                            class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                            id="resetFilter"
                                                            data-kt-menu-dismiss="true">{{ __('messages.common.reset') }}</button>
                                                </div>
                                                <input type="hidden" name="hospitalId" id="hospitalId"
                                                       value="{{$users['hospital']->id}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="hospitalId" id="hospitalBillingId"
                                   value="{{$users['hospital']->id}}"/>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive viewList">
                                    <table id="hospitalBilling"
                                           class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.subscription_plans.plan_name')}}</th>
                                            <th>{{__('messages.subscription_plans.transaction')}}</th>
                                            <th>{{__('messages.subscription_plans.amount')}}</th>
                                            <th>{{__('messages.subscription_plans.frequency')}}</th>
                                            <th>{{__('messages.subscription_plans.start_date')}}</th>
                                            <th>{{__('messages.subscription_plans.end_date')}}</th>
                                            <th>{{__('messages.subscription_plans.trail_end_date')}}</th>
                                            <th>{{ __('messages.common.status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="hTransaction" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.subscription_plans.transactions') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9 pt-6">
                        <div class="card-header border-0 px-0">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                          fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                          fill="#000000" fill-rule="nonzero"/>
                </g>
            </svg>
        </span>
                                    <input type="text" data-datatable-filter="search" id="search-table-transction"
                                           name="search"
                                           class="form-control form-control-solid w-250px ps-14" placeholder="Search"/>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex align-items-center py-1">
                                    <div class="ms-auto">
                                        <a href="#" class="btn btn-flex btn-light-primary fw-bolder"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                           data-kt-menu-flip="top-end">
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                                d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                                fill="#000000"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            {{ __('messages.common.filter') }}</a>
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_6113c71822d0d">
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">{{ __('messages.common.filter_options') }}</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">{{ __('messages.subscription_plans.payment_type').':' }}</label>
                                                    {{ Form::select('status', ['' => 'All'] +$users['paymentType'],null, ['id' => 'paymentType', 'data-control' =>'select2', 'class' => 'form-select form-select-solid status-selector select2-hidden-accessible data-allow-clear="true"']) }}
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                            class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                            id="resetFilter"
                                                            data-kt-menu-dismiss="true">{{ __('messages.common.reset') }}</button>
                                                </div>
                                                <input type="hidden" name="hospitalId" id="hospitalId"
                                                       value="{{$users['hospital']->id}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="hospitalId" id="hospitalTransctionId"
                                   value="{{$users['hospital']->id}}"/>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive viewList">
                                    <table id="hospitalTransaction"
                                           class="table table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{__('messages.subscription_plans.payment')}}</th>
                                            <th>{{__('messages.subscription_plans.amount')}}</th>
                                            <th>{{__('messages.subscription_plans.transaction_date')}}</th>
                                            <th>{{ __('messages.common.status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
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
