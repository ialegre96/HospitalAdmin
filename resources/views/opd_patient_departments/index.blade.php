@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patients') }}
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
                    <a href="{{ route('opd.patient.create') }}"
                       class="btn btn-primary">{{ __('messages.opd_patient.new_opd_patient') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('opd_patient_departments.table')
        </div>
        @include('opd_patient_departments.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let opdPatientUrl = "{{url('opds')}}";
        let patientUrl = "{{url('patients')}}";
        let doctorUrl = "{{url('doctors')}}";
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/opd_patients/opd_patients.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
@endsection
