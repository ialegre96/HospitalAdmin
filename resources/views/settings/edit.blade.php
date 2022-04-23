@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @yield('section')
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";
        let isEdit = true;
        let moduleUrl = '{{ route('module.index') }}';
        let imageValidation = '{{  __('messages.setting.image_validation') }}';
        let searchExist = false;
    </script>
    <script src="{{ mix('assets/js/settings/setting.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endsection
