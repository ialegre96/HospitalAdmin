@extends('layouts.app')
@section('title')
    {{ __('messages.advanced_payment.advanced_payment_details')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">
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
                @include('advanced_payments.show_fields')
            </div>
        </div>
        @include('advanced_payments.edit_modal')
    </div>
@endsection
@section('scripts')
    <script>
        let advancedPaymentUrl = "{{url('advanced-payments')}}";
        let advancePaymentCreateUrl = "{{ route('advanced-payments.store') }}";
        let patientUrl = "{{ url('patients') }}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ mix('assets/js/advanced_payments/advanced_payments.js') }}"></script>
    <script src="{{ mix('assets/js/advanced_payments/create-edit.js') }}"></script>
@endsection
