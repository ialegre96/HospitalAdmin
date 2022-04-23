@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.ipd_patient_details') }}
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
                @include('ipd_patient_list.show_fields')
            </div>
        </div>
    </div>
    @include('ipd_prescriptions.show_modal')
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script src="//js.stripe.com/v3/"></script>
    <script>
        let ipdDiagnosisUrl = "{{route('ipd.diagnosis.index')}}";
        let ipdConsultantRegisterUrl = "{{route('ipd.consultant.index')}}";
        let ipdChargesUrl = "{{route('ipd.charge.index')}}";
        let ipdPatientDepartmentId = "{{ $ipdPatientDepartment->id }}";
        let doctorUrl = "{{url('doctors')}}";
        let ipdPrescriptionUrl = "{{route('ipd.prescription.index')}}";
        let ipdTimelinesUrl = "{{route('ipd.timelines.index')}}";
        let ipdPaymentUrl = "{{route('ipd.payments.index')}}";
        let ipdPaymentModes = JSON.parse('@json($paymentModes)');
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let ipdStripePaymentUrl = '{{ url('stripe-charge') }}';
        let downloadDiagnosisDocumentUrl = "{{ url('ipd-diagnosis-download') }}";
        let downloadPaymetDocumentUrl = "{{ url('ipd-payment-download') }}";
        let downloadTimelineDocumentUrl = "{{ url('ipd-timeline-download') }}";
        let bootstarpUrl = "{{ asset('assets/css/bootstrap.min.css') }}";
    </script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_diagnosis.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_consultant_register.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_charges.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_prescriptions.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_timelines.js') }}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ mix('assets/js/ipd_patients_list/ipd_payments.js') }}"></script>

    <script src="{{ mix('assets/js/ipd_patients_list/ipd_stripe_payment.js') }}"></script>
@endsection
