@extends('layouts.app')
@section('title')
    {{ __('messages.operation_report.operation_reports') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
            <div class="card-toolbar">
                <div class="d-flex align-items-center py-1">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                       data-bs-target="#addModal">{{ __('messages.operation_report.new_operation_report') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('operation_reports.table')
        </div>
        @include('operation_reports.templates.templates')
        @include('operation_reports.create_modal')
        @include('operation_reports.edit_modal')
    </div>
@endsection

@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection

@section('scripts')
    <script>
        let operationReportUrl = "{{url('operation-reports')}}";
        let operationReportCreateUrl = "{{route('operation-reports.store')}}";
        let patientUrl = "{{ url('patients') }}";
        let doctorUrl = "{{ url('doctors') }}";
        let caseUrl = "{{ url('patient-cases') }}";
    </script>
    <script src="{{ mix('assets/js/operation_reports/operation_reports.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/operation_reports/create-edit.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
