<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ $opdPatientDepartment->patient->user->image_url }}" class="object-fit-cover"
                             alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $opdPatientDepartment->patient->user->full_name }}</a>
                                <span
                                    class="badge badge-light-warning fs-7">{{ !empty($opdPatientDepartment->opd_number) ? "#".$opdPatientDepartment->opd_number : __('messages.common.n/a') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto:{{ $opdPatientDepartment->patient->user->email }}"
                                   class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                  fill="black"></path>
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ $opdPatientDepartment->patient->user->email }}
                                </a>
                                <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                @if(!empty($opdPatientDepartment->patient->address->address1) || !empty($opdPatientDepartment->patient->address->address2) || !empty($opdPatientDepartment->patient->address->city) || !empty($opdPatientDepartment->patient->address->zip))
                                        <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                  fill="black"></path>
                                            <path
                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    {{ !empty($opdPatientDepartment->patient->address->address1) ? $opdPatientDepartment->patient->address->address1 : '' }}{{ !empty($opdPatientDepartment->patient->address->address2) ? !empty($opdPatientDepartment->patient->address->address1) ? ',' : '' : '' }}
                                    {{ empty($opdPatientDepartment->patient->address->address1) || !empty($opdPatientDepartment->patient->address->address2)  ? !empty($opdPatientDepartment->patient->address->address2) ? $opdPatientDepartment->patient->address->address2 : '' : '' }}
                                    {{ empty($opdPatientDepartment->patient->address->address1) && empty($opdPatientDepartment->patient->address->address2) ? __('messages.common.n/a') : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex col-12">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                        class="fas fa-book-medical text-dark fa-2x me-2"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{ !empty($opdPatientDepartment->patient->cases) ? $opdPatientDepartment->patient->cases->count() : '' }}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_cases')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                        class="fas fa-calendar-alt fa-2x me-2 text-warning"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{ !empty($opdPatientDepartment->patient->admissions) ? $opdPatientDepartment->patient->admissions->count() : '' }}">
                                        0
                                    </div>
                                </div>
                                <div
                                    class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_admissions')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                        class="fas fa-calendar-check fa-2x me-2 text-info"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{ !empty($opdPatientDepartment->patient->appointments) ? $opdPatientDepartment->patient->appointments->count() : '' }}">
                                        0
                                    </div>
                                </div>
                                <div
                                    class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_appointments')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#poverview">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#opdVisits">{{ __('messages.opd_patient.visits') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#opdDiagnosis">{{ __('messages.ipd_diagnosis') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#opdTimelines">{{ __('messages.ipd_timelines') }}</a>
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
                        <h3 class="fw-bolder m-0">Overview</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.case.case_id')  }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="badge badge-light-info fs-7">{{ !empty($opdPatientDepartment->case_id) ? $opdPatientDepartment->patientCase->case_id : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.height')  }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($opdPatientDepartment->height) ? $opdPatientDepartment->height : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.weight') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ !empty($opdPatientDepartment->weight) ? $opdPatientDepartment->weight : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.bp') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($opdPatientDepartment->bp) ? $opdPatientDepartment->bp : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.opd_patient.appointment_date') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2" data-toggle="tooltip"
                                    data-placement="right"
                                    title="{{ \Carbon\Carbon::parse($opdPatientDepartment->appointment_date)->diffForHumans() }}">{{ date('jS M, Y', strtotime($opdPatientDepartment->appointment_date)) }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.doctor_id') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ $opdPatientDepartment->doctor->user->full_name }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_payments.payment_mode') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($opdPatientDepartment->payment_mode_name) ? $opdPatientDepartment->payment_mode_name : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor_opd_charge.standard_charge') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2"><i class="{{ getCurrenciesClass() }}"></i>&nbsp;{{ !empty($opdPatientDepartment->standard_charge) ? number_format($opdPatientDepartment->standard_charge) : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.is_old_patient') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ ($opdPatientDepartment->is_old_patient) ? __('messages.common.yes') : __('messages.common.no') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                        <span
                                            class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($opdPatientDepartment->created_at) ? $opdPatientDepartment->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                        <span
                                            class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($opdPatientDepartment->updated_at) ? $opdPatientDepartment->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.symptoms') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{!! !empty($opdPatientDepartment->symptoms)?nl2br(e($opdPatientDepartment->symptoms)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.ipd_patient.notes') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{!! !empty($opdPatientDepartment->notes)?nl2br(e($opdPatientDepartment->notes)) : __('messages.common.n/a')  !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="opdVisits" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.visitors') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 1])
                                <div class="table-responsive viewList">
                                    @include('opd_patient_list.opd_listing_tables.visited_table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="opdDiagnosis" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.ipd_diagnosis') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 2])
                                <div class="table-responsive viewList">
                                    @include('opd_patient_list.opd_listing_tables.opd_diagnosis_table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="opdTimelines">
            <div id="opdTimelines"></div>
        </div>
    </div>
</div>
