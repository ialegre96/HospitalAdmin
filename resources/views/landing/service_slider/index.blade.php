@extends('layouts.app')
@section('title')
    {{ __('messages.service_slider.service_slider_image') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
            <div class="me-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">{{__('messages.service_slider.add_service_slider')}}</button>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('landing.service_slider.table')
        </div>
    </div>
    @include('landing.service_slider.create-modal')
    @include('landing.service_slider.edit-modal')
    @include('landing.service_slider.templates.templates')
@endsection
@section('scripts')
    <script>
        let defaultDocumentImageUrl = "{{ asset('web_front/images/main-banner/banner-one/woman-doctor.png') }}";
    </script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/service_slider/service-slider.js')}}"></script>
@endsection
