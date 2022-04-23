@extends('layouts.app')
@section('title')
    {{ __('messages.doctors') }}
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
            @include('employees.doctors.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let doctorUrl = "{{url('employee/doctor')}}";
        let doctorShowUrl = "{{url('employee/doctor')}}";
    </script>
    <script src="{{ mix('assets/js/employee/doctors.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
