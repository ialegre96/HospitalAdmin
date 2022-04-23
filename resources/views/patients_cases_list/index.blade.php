@extends('layouts.app')
@section('title')
    Patients Cases
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('patients_cases_list.table')
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let patientCasesUrl = "{{url('patient/my-cases')}}";
        let patientCaseShowUrl = "{{url('patient/my-cases')}}";
        let patientUrl = "{{url('patients')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{mix('assets/js/patient_cases_list/patient_cases_list.js')}}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection


