@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
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
@section('scripts')
    <script>
        let imageValidation = '{{  __('messages.setting.image_validation') }}';
    </script>
    <script src="{{ mix('assets/js/super_admin_settings/setting.js') }}"></script>
@endsection
