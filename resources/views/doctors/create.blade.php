@extends('layouts.app')
@section('title')
    {{ __('messages.doctor.new_doctor') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">
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
                <a href="{{ route('doctors.index') }}"
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
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'doctors.store', 'files' => 'true', 'id' => 'createDoctorForm']) }}
                    @include('doctors.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";
        let isEdit = false;
        let defaultAvatarImageUrl = "{{ asset('assets/img/avatar.png') }}";
    </script>
    <script src="{{mix('assets/js/doctors/create-edit.js')}}"></script>
    <script src="{{ mix('assets/js/custom/add-edit-profile-picture.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endsection
