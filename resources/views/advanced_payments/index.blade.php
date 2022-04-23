@extends('layouts.app')
@section('title')
    {{ __('messages.advanced_payment.advanced_payments') }}
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        {{__('messages.advanced_payment.new_advanced_payment')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('advanced_payments.table')
        </div>
        @include('advanced_payments.create_modal')
        @include('advanced_payments.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
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
