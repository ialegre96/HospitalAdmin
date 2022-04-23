@extends('layouts.app')
@section('title')
    {{__('messages.sms.sms')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
            <div class="card-toolbar">
                <div class="d-flex align-items-center py-1">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                       data-bs-target="#AddModal">{{__('messages.sms.new_sms')}}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('sms.table')
        </div>
        @include('sms.templates.templates')
        @include('sms.create_modal')
        @include('sms.show_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let smsUrl = "{{url('sms')}}";
        let createSmsUrl = "{{route('sms.store')}}";
        let getUsersListUrl = "{{ route('sms.users.lists') }}";
        let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";
        let isEdit = true;
    </script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/sms/sms.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endsection
