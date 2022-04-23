<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{$doctorData->user->image_url}}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $doctorData->user->full_name }}</a>
                                <span
                                        class="badge badge-light-{{  $doctorData->user->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($doctorData->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto:{{ $doctorData->user->email }}"
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
                                    {{ $doctorData->user->email }}
                                </a>
                                <sapn class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    @if(!empty($doctorData->address->address1) || !empty($doctorData->address->address2) || !empty($doctorData->address->city) || !empty($doctorData->address->zip))
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
                                    {{ !empty($doctorData->address->address1) ? $doctorData->address->address1 : '' }}{{ !empty($doctorData->address->address2) ? !empty($doctorData->address->address1) ? ',' : '' : '' }}
                                    {{ empty($doctorData->address->address1) || !empty($doctorData->address->address2)  ? !empty($doctorData->address->address2) ? $doctorData->address->address2 : '' : '' }}
                                    {{ !empty($doctorData->address->city) ? ','.$doctorData->address->city : '' }} {{ !empty($doctorData->address->zip) ? ','. $doctorData->address->zip : '' }}
                                </sapn>
                            </div>
                        </div>
                        <div class="d-flex col-12">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                            class="fas fa-book-medical fa-2x me-2 text-black"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{!empty($doctorData->cases) ? $doctorData->cases->count() : ''}}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_cases')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                            class="fas fa-calendar-alt fa-2x me-2 text-warning"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{!empty($doctorData->patients) ? $doctorData->patients->count() : ''}}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patients')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i
                                            class="fas fa-calendar-check fa-2x me-2 text-info"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{!empty($doctorData->appointments) ? $doctorData->appointments->count() : ''}}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_appointments')}}</div>
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
                           href="#dcases">{{ __('messages.cases') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#dpatients">{{ __('messages.patients') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#dappointments">{{ __('messages.appointments') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#dschedules">{{ __('messages.schedules') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                           href="#dpayroll">{{ __('messages.my_payroll.my_payrolls') }}</a>
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
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.designation') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{$doctorData->user->designation ?? __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.phone') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{!empty($doctorData->user->phone)?($doctorData->user->phone):__('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label
                                    class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.doctor_department') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{getDoctorDepartment($doctorData->doctor_department_id)}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.qualification') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{$doctorData->user->qualification ?? __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.blood_group') }}</label>
                            <div class="col-lg-8 fv-row">
                                @if(!empty($doctorData->user->blood_group))
                                    <span
                                            class="badge fs-6 badge-light-{{ !empty($doctorData->user->blood_group) ? 'success' : 'danger'  }}"> {{ $doctorData->user->blood_group }} </span>
                                @else
                                    <span
                                            class="fw-bolder fs-6 text-gray-800 me-2">{{ __('messages.common.n/a')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.dob') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorData->user->dob) ? \Carbon\Carbon::parse($doctorData->user->dob)->format('jS M, Y') : __('messages.common.n/a')}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.specialist') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$doctorData->specialist}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ ($doctorData->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorData->user->created_at) ? $doctorData->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                        class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($doctorData->user->updated_at) ? $doctorData->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="dcases" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.cases') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 1])
                                <div class="table-responsive viewList">
                                    <table id="doctorCases"
                                           class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-5 text-center">{{ __('messages.case.case_id') }}</th>
                                            <th class="w-10">{{ __('messages.case.patient') }}</th>
                                            {{--                                            <th class="w-25">{{ __('messages.case.description') }}</th>--}}
                                            <th class="w-10">{{ __('messages.case.phone') }}</th>
                                            <th class="w-15">{{ __('messages.case.case_date') }}</th>
                                            <th class="w-5 text-right">{{ __('messages.case.fee') }}</th>
                                            <th class="w-5 text-center">{{ __('messages.common.status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($doctorData->cases as $case)
                                            <tr>
                                                <td class="text-center"><span
                                                            class="badge badge-light-info">{{ $case->case_id }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{ url('patients',$case->patient_id) }}">
                                                                <div>
                                                                    <img src="{{$case->patient->user->ImageUrl}}" alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('patients',$case->patient_id) }}"
                                                               class="mb-1">{{ $case->patient->user->full_name }}</a>
                                                            <span>{{ $case->patient->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{--                                                <td class="text-truncate"--}}
                                                {{--<!--                                                --><?php--}}
                                                {{--//                                                $style = 'style=';--}}
                                                {{--//                                                $maxWidth = 'max-width:';--}}
                                                {{--//                                                ?>--}}
                                                {{--                                                    {{$style}}"{{$maxWidth}} 150px">{!! (!empty($case->description)) ? nl2br(e($case->description)) : __('messages.common.n/a') !!}</td>--}}
                                                <td>{{ (!empty($case->phone)) ? $case->phone : __('messages.common.n/a') }}</td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($case->date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($case->date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($case->fee, 2) }}
                                                </td>
                                                <td class="text-center"><span
                                                            class="badge badge-light-{{($case->status == 1) ? 'success' : 'danger'}}">{{ ($case->status) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
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
        <div class="tab-pane fade" id="dpatients" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.patients') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 2])
                                <div class="table-responsive viewList">
                                    <table id="doctorPatients"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10">{{ __('messages.case.patient') }}</th>
                                            <th class="w-10">{{ __('messages.user.phone') }}</th>
                                            <th class="w-5">{{ __('messages.user.blood_group') }}</th>
                                            <th class="w-10 text-center">{{ __('messages.common.status') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($doctorData->patients as $patient)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{ url('patients',$patient->id) }}">
                                                                <div>
                                                                    <img src="{{$patient->user->ImageUrl}}" alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('patients',$patient->id) }}"
                                                               class="mb-1">{{ $patient->user->full_name }}</a>
                                                            <span>{{ $patient->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ (!empty($patient->user->phone)) ? $patient->user->phone : __('messages.common.n/a') }}</td>
                                                <td>@if(!empty($patient->user->blood_group))
                                                        <span
                                                                class="badge fs-6 badge-light-{{ !empty($patient->user->blood_group) ? 'success' : 'danger'  }}"> {{ $patient->user->blood_group }} </span>
                                                    @else
                                                        <span
                                                                class="fw-bolder fs-6 text-gray-800 me-2">{{ __('messages.common.n/a')}}</span>
                                                    @endif</td>
                                                <td class="text-center"><span
                                                            class="badge badge-light-{{($patient->user->status == 1) ? 'success' : 'danger'}}">{{ (!empty($patient->user->status)) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
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
        <div class="tab-pane fade" id="dappointments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.appointments') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 3])
                                <div class="table-responsive viewList">
                                    <table id="doctorAppointments"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10">{{ __('messages.appointment.patient') }}</th>
                                            <th class="w-10">{{ __('messages.appointment.doctor') }}</th>
                                            <th class="w-10">{{ __('messages.appointment.doctor_department') }}</th>
                                            <th class="w-10">{{ __('messages.appointment.date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{ url('patients',$appointment->patient_id) }}">
                                                                <div>
                                                                    <img src="{{$appointment->patient->user->ImageUrl}}"
                                                                         alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('patients',$appointment->patient_id) }}"
                                                               class="mb-1">{{ $appointment->patient->user->full_name }}</a>
                                                            <span>{{ $appointment->patient->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{ url('doctors',$appointment->doctor_id) }}">
                                                                <div>
                                                                    <img src="{{$appointment->doctor->user->ImageUrl}}"
                                                                         alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('doctors',$appointment->doctor_id) }}"
                                                               class="mb-1">{{ $appointment->doctor->user->full_name }}</a>
                                                            <span>{{ $appointment->doctor->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $appointment->department->title }}</td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($appointment->opd_date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($appointment->opd_date)->format('jS M, Y') }}</div>
                                                    </div>
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
        <div class="tab-pane fade" id="dschedules" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.schedules') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 4])
                                <div class="table-responsive viewList">
                                    <table id="doctorSchedules"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-20">{{ __('messages.schedule.available_on') }}</th>
                                            <th class="w-40">{{ __('messages.schedule.available_from') }}</th>
                                            <th class="w-40">{{ __('messages.schedule.available_to') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($doctorData->schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->available_on }}</td>
                                                <td>{{ $schedule->available_from }}</td>
                                                <td>{{ $schedule->available_to }}</td>
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
        <div class="tab-pane fade" id="dpayroll" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.my_payroll.my_payrolls') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 5])
                                <div class="table-responsive viewList">
                                    <table id="doctorPayrolls"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 dataTable no-footer w-100">
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
                                        @foreach($doctorData->payrolls as $payroll)
                                            <tr>
                                                <td class="text-center">{{ $payroll->payroll_id }}</td>
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
                                                            class="badge fs-6 badge-light-{{($payroll->status == 1 ) ? 'success' : 'danger'}}">{{ ($payroll->status) ? __('messages.employee_payroll.paid') : __('messages.employee_payroll.not_paid') }}</span>
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
