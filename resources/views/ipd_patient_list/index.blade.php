@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.ipd_patients') }}
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
            @include('ipd_patient_list.table')
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection

@section('scripts')
    <script>
        let ipdPatientUrl = "{{url('patient/my-ipds')}}";
    </script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_patients.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
