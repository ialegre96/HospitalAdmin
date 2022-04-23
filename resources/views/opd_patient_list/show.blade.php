@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patient.opd_patient_details') }}
@endsection

@section('page_css')
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
                @include('opd_patient_list.show_fields')
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        // store the currently selected tab in the hash value
        $('ul.nav-tabs > li > a').on('shown.bs.tab', function (e) {
            var id = $(e.target).attr('href').substr(1);
            window.location.hash = id;
        });
        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;

        let visitedOPDPatients = "{{ route('patient.opd') }}";
        let patient_id = "{{ $opdPatientDepartment->patient_id }}";
        let opdPatientDepartmentId = "{{ $opdPatientDepartment->id }}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
        let opdDiagnosisUrl = "{{route('opd.diagnosis.index')}}";
        let downloadDiagnosisDocumentUrl = "{{ url('opd-diagnosis-download')}}";
        let opdTimelinesUrl = "{{route('opd.timelines.index')}}";
        let downloadTimelineDocumentUrl = "{{ url('opd-timeline-download') }}";
        let downloadPaymetDocumentUrl = "{{ url('opdPayment-download') }}";
    </script>
    <script src="{{ mix('assets/js/opd_patients_list/visits.js') }}"></script>
    <script src="{{ mix('assets/js/opd_patients_list/opd_diagnosis.js') }}"></script>
    <script src="{{ mix('assets/js/opd_patients_list/opd_timelines.js') }}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
@endsection
