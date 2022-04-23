@extends('layouts.app')
@section('title')
    {{ __('messages.appointment.appointment_calendar') }}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/plugins/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                <a href="{{ route('appointments.index') }}"
                   class="btn btn-sm btn-primary">{{ __('messages.appointment.appointment_list') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body p-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Appointment show modal --}}
    <div id="appointmentDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ __('messages.appointment.appointment_details') }}</h2>
                    <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                            data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                    </button>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <div class="row">
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('patient_name', __('messages.case.patient').(':'), ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <p id="patientName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('department_name', __('messages.appointment.doctor_department').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <p id="departmentName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('doctor_name', __('messages.case.doctor').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <p id="doctorName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('opd_date', __('messages.appointment.date').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <br>
                            <p id="opdDate"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('problem', __('messages.common.status').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <p id="is_completed"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('problem', __('messages.appointment.description').(':'),['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            <p id="problem"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('appointment_calendars.add_appointment_modal')
    @include('appointments.templates.appointment_slot')
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/plugins/fullcalendar.bundle.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let todayText = '{{ __('messages.appointment.today') }}';
        let monthText = '{{ __('messages.appointment.month') }}';
        let weekText = '{{ __('messages.appointment.week') }}';
        let dayText = '{{ __('messages.appointment.day') }}';
        let doctorScheduleList = "{{ url('doctor-schedule-list') }}";
        let calenderAppointmentSaveUrl = "{{ route('appointments.store') }}";
        let calenderIndexPage = "{{ route('appointment-calendars.index') }}";
        let getBookingSlot = "{{ route('get.booking.slot') }}";
        let userRole = "{{ Auth::user()->hasRole('Doctor')}}";
        let isCreate = true;
        let isDoctor = {{(Auth::user()->hasRole('Doctor'))? 1 :0 }};
    </script>
    <script src="{{mix('assets/js/appointment_calendar/appointment_calendar.js')}}"></script>
@endsection
