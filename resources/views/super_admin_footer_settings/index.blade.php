@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            {{ Form::open(['route' => 'super.admin.footer.settings.update','method'=>'POST', 'id'=>'superAdminFooterSettingForm']) }}
            @include('super_admin_footer_settings.field')
            {{ Form::close() }}
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
        let phoneNo = "{{ old('prefix_code').old('phone') }}";
    </script>
    <script src="{{ mix('assets/js/super_admin_settings/setting.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endsection
