@extends('layouts.app')
@section('title')
    {{ __('messages.live_meetings') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
            <div class="card-toolbar">
                <div class="d-flex align-items-center py-1">
                    <div class="me-4">
                        <a href="#" class="btn btn-flex btn-light-primary fw-bolder"
                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
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
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                             id="kt_menu_6113c71822d0d">
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">{{ __('messages.common.filter_options') }}</div>
                            </div>
                            <div class="separator border-gray-200"></div>
                            <div class="px-7 py-5">
                                <div class="mb-10">
                                    <label
                                        class="form-label fs-6 fw-bold">{{ __('messages.common.status').':' }}</label>
                                    {{ Form::select('status',['' => 'All'] +$status,null, ['id' => 'statusArr', 'data-control' =>'select2', 'class' => 'form-select form-select-solid status-selector select2-hidden-accessible data-allow-clear="true"']) }}
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm fs-6 btn-light btn-active-light-primary me-2"
                                            id="resetFilter"
                                            data-kt-menu-dismiss="true">{{ __('messages.common.reset') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (getLoggedInUser()->hasRole(['Admin', 'Doctor']))
                        <div class="mr-2 actions-btn">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                               data-bs-target="#addModal">{{ __('messages.live_consultation.new_live_meeting') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('live_consultations.member_table')
        </div>
        @include('live_consultations.templates.templates')
        @include('live_consultations.add_meeting_modal')
        @include('live_consultations.edit_meeting_modal')
        @include('live_consultations.start_meeting_modal')
        @include('live_consultations.show_meeting_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let liveMeetingUrl = "{{ route('live.meeting.index') }}";
        let liveMeetingCreateUrl = "{{ route('live.meeting.store') }}";
        let doctorRole = "{{getLoggedInUser()->hasRole('Doctor')?true:false}}";
        let adminRole = "{{getLoggedInUser()->hasRole('Admin')?true:false}}";
    </script>
    <script src="{{mix('assets/js/live_consultations/live_meetings.js')}}"></script>
    <script src="{{ mix('assets/js/custom/new-edit-modal-form.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
