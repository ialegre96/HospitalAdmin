@extends('layouts.app')
@section('title')
    {{ __('messages.prescriptions') }}
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
                    @if (getLoggedInUser()->hasRole('Pharmacist'))
                        <a href="{{ route('employee.prescriptions.excel') }}"
                           class="btn btn-primary">{{ __('messages.common.export_to_excel') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('employee_prescription_list.table')
        </div>
        @include('employee_prescription_list.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let prescriptionUrl = "{{url('employee/prescriptions')}}";
        let employeeUrl = "{{url('employee')}}";
    </script>
    <script src="{{ mix('assets/js/employee_prescriptions/employee_prescriptions.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
