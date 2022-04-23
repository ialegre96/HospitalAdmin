@extends('layouts.app')
@section('title')
    {{ __('messages.vaccinated_patients') }}
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
            @include('patient_vaccinated_list.table')
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        let patientVaccinatedUrl = "{{ route('patient.vaccinated') }}";
    </script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ mix('assets/js/vaccinated_patients/patient_vaccinated.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
