@extends('layouts.app')
@section('title')
    {{ __('messages.front_cms_services') }}
@endsection
@section('page_css')
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
                       data-bs-target="#addModal">{{ __('messages.front_services.new_service') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('front_settings.front_services.table')
        </div>
        @include('front_settings.front_services.add_modal')
        @include('front_settings.front_services.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let fontServicesUrl = "{{ route('front.cms.services.index') }}";
        let fontServicesCreateUrl = "{{ route('front.cms.services.store') }}";
        let defaultDocumentImageUrl = "{{ asset('web_front/images/services/medicine.png') }}";
    </script>
    <script src="{{ mix('assets/js/front_settings/front_services/front_services.js') }}"></script>
@endsection
