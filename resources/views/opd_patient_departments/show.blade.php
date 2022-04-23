@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patient.opd_patient_details') }}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('css')
    <link href="{{ asset('assets/css/timeline.css') }}" rel="stylesheet" type="text/css"/>
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
                <a href="{{ url()->previous() }}"
                   class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                            @include('opd_patient_departments.show_fields')
                        </div>
                    </div>
    @include('opd_diagnoses.add_modal')
    @include('opd_diagnoses.edit_modal')
    @include('opd_diagnoses.templates.templates')
    @include('opd_patient_departments.templates.templates')
    @include('opd_timelines.add_modal')
    @include('opd_timelines.edit_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let visitedOPDPatients = "{{ route('opd.patient.index') }}";
        let opdPatientUrl = "{{url('opds')}}";
        let doctorUrl = "{{url('doctors')}}";
        let patient_id = "{{ $opdPatientDepartment->patient_id }}";
        let opdPatientDepartmentId = "{{ $opdPatientDepartment->id }}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
        let opdDiagnosisCreateUrl = "{{route('opd.diagnosis.store')}}";
        let opdDiagnosisUrl = "{{route('opd.diagnosis.index')}}";
        let downloadDiagnosisDocumentUrl = "{{ url('opd-diagnosis-download')}}";
        let opdTimelineCreateUrl = "{{route('opd.timelines.store')}}";
        let opdTimelinesUrl = "{{route('opd.timelines.index')}}";
        let opdPatientCaseDate = "{{ $opdPatientDepartment->patientCase->date }}";
        let id = "{{ $opdPatientDepartment->id }}";
        let appointmentDate = "{{ $opdPatientDepartment->appointment_date }}";
    </script>
{{--    <script src="{{ mix('assets/js/opd_tab_active/opd_tab_active.js') }}"></script>--}}
    <script src="{{ mix('assets/js/opd_patients/visits.js') }}"></script>
    <script src="{{ mix('assets/js/opd_diagnosis/opd_diagnosis.js') }}"></script>
    <script src="{{ mix('assets/js/opd_timelines/opd_timelines.js') }}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ mix('assets/js/custom/new-edit-modal-form.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
