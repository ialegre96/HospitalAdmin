@extends('layouts.app')
@section('title')
    {{ __('messages.patient.patient_details') }}
@endsection
@section('page_css')
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
                @if (!Auth::user()->hasRole('Doctor|Accountant|Case Manager|Nurse|Patient'))
                    <a href="{{ route('patients.edit',['patient' => $data->id]) }}"
                       class="btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                @endif
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
                @include('patients.show_fields')
            </div>
            @include('patients.advanced_payments.edit_modal')
            @include('patients.vaccinations.edit_modal')
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        let advancedPaymentUrl = "{{url('advanced-payments')}}";
        let advancePaymentCreateUrl = "{{ route('advanced-payments.store') }}";
        let patientUrl = "{{ url('patients') }}";
        let vaccinatedPatientUrl = "{{ route('vaccinated-patients.index') }}";
    </script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/patients/patients_data_listing.js') }}"></script>
@endsection
