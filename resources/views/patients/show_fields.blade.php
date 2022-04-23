<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ $data->user->image_url }}" class="object-fit-cover" alt="image"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 fw-bolder me-4">{{ $data->user->full_name }}</a>
                                <span
                                    class="badge badge-light-{{ $data->user->status === 1 ? 'success' : 'danger' }} fw-bolder ms-2 fs-8 py-1 px-3">{{ ($data->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="mailto:{{ $data->user->email }}"
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
                                    {{ $data->user->email }}
                                </a>
                                <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                @if(!empty($data->address->address1) || !empty($data->address->address2) || !empty($data->address->city) || !empty($data->address->zip))
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
                                    {{ !empty($data->address->address1) ? $data->address->address1 : '' }}{{ !empty($data->address->address2) ? !empty($data->address->address1) ? ',' : '' : '' }}
                                    {{ empty($data->address->address1) || !empty($data->address->address2)  ? !empty($data->address->address2) ? $data->address->address2 : '' : '' }}
                                    {{ empty($data->address->address1) && empty($data->address->address2) ? '' : '' }}{{ !empty($data->address->city) ? ','.$data->address->city : '' }}{{ !empty($data->address->zip) ? ','.$data->address->zip : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex col-12">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-book-medical fa-2x me-2 text-dark"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true"
                                         data-kt-countup-value="{{!empty($data->cases) ? $data->cases->count() : ''}}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_cases')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-calendar-alt fa-2x me-2 text-warning"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true" data-kt-countup-value="{{!empty($data->admissions) ? $data->admissions->count() : ''}}">
                                        0
                                    </div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">{{__('messages.patient.total_admissions')}}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-calendar-check fa-2x me-2 text-info"></i>
                                    <div class="fs-2 fw-bolder text-gray-800" data-kt-countup="true" data-kt-countup-value="{{!empty($data->appointments) ? $data->appointments->count() : ''}}">
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
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pcases">{{ __('messages.cases') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#padmissions">{{ __('messages.patient_admissions') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pappointments">{{ __('messages.appointments') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pbills">{{ __('messages.bills') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pinvoices">{{ __('messages.invoices') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pAdvancedPayments">{{ __('messages.advanced_payments') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pDocument">{{ __('messages.documents') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#pVaccinated">{{ __('messages.vaccinations') }}</a>
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
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.phone') }}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($data->user->phone) ? $data->user->phone :__('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.gender') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ ($data->user->gender != 1) ? __('messages.user.male') : __('messages.user.female') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.user.blood_group') }}</label>
                            <div class="col-lg-8 fv-row">
                                @if(!empty($data->user->blood_group))
                                    <span
                                        class="badge fs-6 badge-light-{{ !empty($data->user->blood_group) ? 'success' : 'danger'  }}"> {{ $data->user->blood_group }} </span>
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
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($data->user->dob) ? \Carbon\Carbon::parse($data->user->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.created_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($data->user->created_at) ? $data->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.common.updated_at') }}</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800 me-2">{{ !empty($data->user->updated_at) ? $data->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pcases" role="tabpanel">
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
                                    <table id="patientCases"
                                           class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{ __('messages.case.case_id') }}</th>
                                            <th>{{ __('messages.case.doctor') }}</th>
                                            <th>{{ __('messages.case.case_date') }}</th>
                                            <th>{{ __('messages.case.fee') }}</th>
                                            <th class="text-center">{{ __('messages.common.status') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse'))
                                            <th class="text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->cases as $case)
                                            <tr>
                                                <td>
                                                    @if(!Auth::user()->hasRole('Patient|Nurse|Case Manager|Accountant'))
                                                        <a href="{{ url('patient-cases', $case->id) }}"><span
                                                                class="badge badge-light-info">{{ $case->case_id }}</span></a>
                                                    @else
                                                        <span
                                                            class="badge badge-light-info fs-7">{{ $case->case_id }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if(Auth::user()->hasRole('Patient|Nurse|Case Manager'))
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <div>
                                                                    <img src="{{ $case->doctor->user->imageUrl }}"
                                                                         alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                            <span
                                                                class="mb-1">{{ $case->doctor->user->full_name }}</span>
                                                                <span>{{ $case->doctor->user->email }}</span>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="{{ url('doctors',$case->doctor->id) }}">
                                                                    <div>
                                                                        <img src="{{ $case->doctor->user->imageUrl }}"
                                                                             alt=""
                                                                             class="user-img">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <a href="{{ url('doctors',$case->doctor->id) }}"
                                                                   class="mb-1">{{ $case->doctor->user->full_name }}</a>
                                                                <span>{{ $case->doctor->user->email }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="word-nowrap">
                                                        <div class="badge badge-light">
                                                            <div class="mb-2">{{ \Carbon\Carbon::parse($case->date)->format('g:i A') }}</div>
                                                            <div>{{ \Carbon\Carbon::parse($case->date)->format('jS M, Y') }}</div>
                                                        </div>
                                                </td>
                                                <td class="text-right word-nowrap">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($case->fee, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    @if($case->status)
                                                        <span
                                                            class="badge badge-light-success">{{__('messages.common.active')}}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-light-danger">{{ __('messages.common.de_active') }}</span>
                                                    @endif
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse'))
                                               <td class="text-center">@include('layouts.action-component-for-detail', ['id' => $case->id, 'url' => route('patient-cases.edit', $case->id), 'deleteUrl' => url('patient-cases'), 'message' => 'Case'])</td>
                                                @endif
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
        <div class="tab-pane fade" id="padmissions" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.patient_admissions') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 2])
                                <div class="table-responsive viewList">
                                    <table id="patientAdmissions"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10">{{ __('messages.bill.admission_id') }}</th>
                                            <th class="w-10">{{ __('messages.patient_admission.doctor') }}</th>
                                            <th class="w-10">{{ __('messages.patient_admission.admission_date') }}</th>
                                            <th class="w-10">{{ __('messages.patient_admission.discharge_date') }}</th>
                                            <th class="w-10 text-center">{{ __('messages.common.status') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse'))
                                            <th class="text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->admissions as $admission)
                                            <tr>
                                                <td>
                                                    @if(Auth::user()->hasRole('Admin|Doctor|Case Manager'))
                                                        <a href="{{ url('patient-admissions',$admission->id) }}"><span
                                                                class="badge badge-light-info">{{ $admission->patient_admission_id }}</span></a>
                                                    @else
                                                        <span
                                                            class="badge badge-light-info">{{ $admission->patient_admission_id }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if(Auth::user()->hasRole('Patient|Nurse|Case Manager'))
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <div>
                                                                    <img src="{{ $admission->doctor->user->imageUrl }}"
                                                                         alt=""
                                                                         class="user-img">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                            <span
                                                                class="mb-1">{{ $admission->doctor->user->full_name }}</span>
                                                                <span>{{ $admission->doctor->user->email }}</span>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="{{ url('doctors',$admission->doctor->id) }}">
                                                                    <div>
                                                                        <img
                                                                            src="{{ $admission->doctor->user->imageUrl }}"
                                                                            alt=""
                                                                            class="user-img">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <a href="{{ url('doctors',$admission->doctor->id) }}"
                                                                   class="mb-1">{{ $admission->doctor->user->full_name }}</a>
                                                                <span>{{ $admission->doctor->user->email }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($admission->admission_date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($admission->admission_date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(!empty($admission->discharge_date))
                                                        <div class="badge badge-light">
                                                            <div class="mb-2">{{ \Carbon\Carbon::parse($admission->discharge_date)->format('g:i A') }}</div>
                                                            <div>{{ \Carbon\Carbon::parse($admission->discharge_date)->format('jS M, Y') }}</div>
                                                        </div>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($admission->status)
                                                        <span
                                                            class="badge badge-light-success">{{__('messages.common.active')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-light-danger">{{__('messages.common.de_active') }}</span>@endif
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse'))
                                                <td class="text-center">@include('layouts.action-component-for-detail', ['id' => $admission->id, 'url' => route('patient-admissions.edit', $admission->id), 'deleteUrl' => url('patient-admissions'), 'message' => 'patient Admissions'])</td>
                                                @endif
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
        <div class="tab-pane fade" id="pappointments" role="tabpanel">
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
                                    <table id="patientAppointments"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-250px">{{ __('messages.appointment.doctor') }}</th>
                                            <th class="w-250px">{{ __('messages.appointment.doctor_department') }}</th>
                                            <th class="w-200px">{{ __('messages.appointment.date') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager'))
                                            <th class="text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->appointments as $appointment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if(Auth::user()->hasRole('Admin|Doctor|Lab Technician|Pharmacist|Accountant'))
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="{{ url('employee/doctor',$appointment->doctor->id) }}">
                                                                    <div>
                                                                        <img
                                                                            src="{{ $appointment->doctor->user->imageUrl }}"
                                                                            alt=""
                                                                            class="user-img">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <a href="{{ url('employee/doctor',$appointment->doctor->id) }}"
                                                                   class="mb-1">{{ $appointment->doctor->user->full_name }}</a>
                                                                <span>{{ $appointment->doctor->user->email }}</span>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <div>
                                                                    <img
                                                                        src="{{ $appointment->doctor->user->imageUrl }}"
                                                                        alt=""
                                                                        class="user-img">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                            <span
                                                                class="mb-1">{{ $appointment->doctor->user->full_name }}</span>
                                                                <span>{{ $appointment->doctor->user->email }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $appointment->doctor->department->title }}</td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($appointment->opd_date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($appointment->opd_date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager'))
                                                <td class="text-center">@include('layouts.action-component-for-detail', ['id' => $appointment->id, 'url' => route('appointments.edit', $appointment->id), 'deleteUrl' => url('appointments'), 'message' => 'Appointment'])</td>
                                                @endif
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
        <div class="tab-pane fade" id="pbills" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.bills') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 4])
                                <div class="table-responsive viewList">
                                    <table id="patientBills"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-25">{{ __('messages.bill.bill_id') }}</th>
                                            <th class="w-25">{{ __('messages.bill.bill_date') }}</th>
                                            <th class="w-25">{{ __('messages.bill.amount') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
                                            <th class="w-25 text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->bills as $bill)
                                            <tr>
                                                <td>
                                                    @if(Auth::user()->hasRole('Admin|Patient'))
                                                        <a href="{{ url('employee/bills',$bill->id) }}">
                                                            <span class="badge badge-light-info">{{ $bill->patient_admission_id }}</span></a>
                                                    @elseif(Auth::user()->hasRole('Accountant'))
                                                        <a href="{{ url('bills',$bill->id) }}">
                                                            <span
                                                                class="badge badge-light-info">{{ $bill->patient_admission_id }}</span></a>
                                                    @else
                                                        <span
                                                            class="badge badge-light-info">{{ $bill->patient_admission_id }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($bill->bill_date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($bill->bill_date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-start">
                                                    <b>{{ getCurrencySymbol() }}</b>{{ number_format($bill->amount, 2) }}
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
                                                <td class="text-center">@include('layouts.action-component-for-detail', ['id' => $bill->id, 'url' => route('bills.edit', $bill->id), 'deleteUrl' => url('bills'), 'message' => 'Bill'])</td>
                                                @endif
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
        <div class="tab-pane fade" id="pinvoices" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.invoices') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 5])
                                <div class="table-responsive viewList">
                                    <table id="patientInvoices" class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-25">{{ __('Invoice Id') }}</th>
                                            <th class="w-25 text-center">{{ __('messages.invoice.invoice_date') }}</th>
                                            <th class="w-25 text-center">{{ __('messages.common.status') }}</th>
                                            <th class="w-10">{{ __('messages.invoice.amount') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
                                                <th class="w-25 text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->invoices as $invoice)
                                            <tr>
                                                <td>
                                                    @if(!Auth::user()->hasRole('Case Manager|Doctor|Nurse|Patient|Receptionist'))
                                                        <a href="{{url('invoices', $invoice->id)}}"><span class="badge badge-light-info">{{$invoice->invoice_id}}</span></a>
                                                    @else
                                                        <span class="badge badge-light-info">{{$invoice->invoice_id}}</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    @if(Auth::user()->hasRole('Admin|Patient'))
                                                        <a href="{{ url('employee/invoices',$invoice->id) }}">
                                                        <div class="badge badge-light">
                                                            <div class="mb-2">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('g:i A') }}</div>
                                                            <div>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M, Y') }}</div>
                                                        </div>
                                                        </a>
                                                    @elseif(Auth::user()->hasRole('Accountant'))
                                                        <a href="{{ url('invoices',$invoice->id) }}">
                                                            <div class="badge badge-light">
                                                                <div class="mb-2">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('g:i A') }}</div>
                                                                <div>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M, Y') }}</div>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <div class="badge badge-light">
                                                            <div class="mb-2">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('g:i A') }}</div>
                                                            <div>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M, Y') }}</div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($invoice->status)
                                                        <span class="badge badge-light-success">{{__('messages.invoice.paid')}}</span>
                                                    @else
                                                        <span class="badge badge-light-danger">{{__('messages.invoice.not_paid') }}</span>
                                                    @endif</td>
                                                <td class="text-center p-0">
                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100), 2) }}
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist'))
                                                <td class="text-center">@include('layouts.action-component-for-detail', ['id' => $invoice->id, 'url' => route('invoices.edit', $invoice->id), 'deleteUrl' => url('invoices'), 'message' => 'Invoice'])</td>
                                                @endif
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
        <div class="tab-pane fade" id="pAdvancedPayments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.advanced_payments') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 6])
                                <div class="table-responsive viewList">
                                    <table id="patientAdvancedPayments"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-25">{{ __('messages.advanced_payment.receipt_no') }}</th>
                                            <th class="w-25">{{ __('messages.advanced_payment.date') }}</th>
                                            <th class="w-25 text-center">{{ __('messages.advanced_payment.amount') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                            <th class="w-25 text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->advancedpayments as $advancedPayment)
                                            <tr>
                                                <td>
                                                    @if(!Auth::user()->hasRole('Patient|Nurse|Case Manager|Accountant|Doctor|Receptionist'))
                                                        <a href="{{url('advanced-payments', $advancedPayment->id)}}"><span
                                                                class="badge badge-light-info">{{ $advancedPayment->receipt_no }}</span></a>
                                                    @else
                                                        <span
                                                            class="badge badge-light-info">{{ $advancedPayment->receipt_no }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div>{{ \Carbon\Carbon::parse($advancedPayment->date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <b>{{ getCurrencySymbol() }}</b>{{ number_format($advancedPayment->amount, 2) }}
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                       title="{{ __('messages.common.edit') }}"
                                                       class="btn btn-icon edit-advancedPayment-btn btn-bg-light btn-active-color-primary btn-sm me-1"
                                                       data-id="{{ $advancedPayment->id }}">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <path
                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                                                            <path
                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    @include('partials.modal.delete_action_component_for_modal', ['id' => $advancedPayment->id, 'deleteUrl' => route('advanced-payments.index'), 'message' => 'Advanced Payment'])
                                                </td>
                                                @endif
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
        <div class="tab-pane fade" id="pDocument" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.documents') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 7])
                                <div class="table-responsive viewList">
                                    <table id="patientDocuments"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-25">{{ __('messages.document.document_type') }}</th>
                                            <th class="w-50">{{ __('messages.document.title') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                            <th class="w-25 text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->documents as $document)
                                            <tr>
                                                <td>{{$document->documentType->name}}</td>
                                                <td>{{$document->title}}</td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                                <td class="text-center">
                                                    @if (!empty($document->document_url))
                                                        <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                           href="{{url('document-download',$document->id)}}"><i
                                                                class="fa fa-download" aria-hidden="true"></i></a>
                                                    @endif
                                                    @include('partials.modal.delete_action_component_for_modal', ['id' => $document->id, 'deleteUrl' => route('documents.index'), 'message' => 'Document'])
                                                </td>
                                                @endif
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
        <div class="tab-pane fade" id="pVaccinated" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.vaccinations') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('layouts.search-component-for-detail', ['id' => 8])
                                <div class="table-responsive viewList">
                                    <table id="patientVaccinated"
                                           class="display table table-striped table-responsive-sm align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                                        <thead>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>{{ __('messages.vaccinated_patient.vaccination_name') }}</th>
                                            <th>{{ __('messages.vaccinated_patient.serial_no') }}</th>
                                            <th>{{ __('messages.vaccinated_patient.does_no') }}</th>
                                            <th>{{ __('messages.vaccinated_patient.dose_given_date') }}</th>
                                            @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                            <th class="text-center">{{ __('messages.common.action') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="fw-bold">
                                        @foreach($data->vaccinations as $vaccination)
                                            <tr>
                                                <td class="w-5">{{ $vaccination->vaccination->name }}</td>
                                                <td class="w-10">
                                                    @if(!empty($vaccination->vaccination_serial_number))
                                                        <span class="badge badge-light-info fs-7">{{$vaccination->vaccination_serial_number}}</span>
                                                    @else
                                                        <span class="badge badge-light-danger fs-7">{{ __('messages.common.n/a')}}</span>
                                                    @endif
                                                </td>
                                                <td class="w-10">
                                                    @if(!empty($vaccination->dose_number))
                                                        <span class="badge badge-light-info fs-7">{{$vaccination->dose_number}}</span>
                                                    @else
                                                        <span class="badge badge-light-danger fs-7">{{ __('messages.common.n/a')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        <div class="mb-2">{{ \Carbon\Carbon::parse($vaccination->dose_given_date)->format('g:i A') }}</div>
                                                        <div>{{ \Carbon\Carbon::parse($vaccination->dose_given_date)->format('jS M, Y') }}</div>
                                                    </div>
                                                </td>
                                                @if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                       title="{{ __('messages.common.edit') }}"
                                                       class="btn btn-icon edit-vaccination-btn btn-bg-light btn-active-color-primary btn-sm me-1"
                                                       data-id="{{ $vaccination->id }}">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <path
                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"/>
                                                            <path
                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    @include('partials.modal.delete_action_component_for_modal', ['id' => $vaccination->id, 'deleteUrl' => route('vaccinated-patients.index'), 'message' => 'Vaccination'])
                                                </td>
                                                @endif
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
