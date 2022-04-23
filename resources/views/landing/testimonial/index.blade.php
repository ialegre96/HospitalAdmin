@extends('layouts.app')
@section('title')
    {{ __('messages.testimonials') }}
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">{{ __('messages.testimonial.new_testimonial') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('landing.testimonial.table')
        </div>
        @include('landing.testimonial.create-modal')
        @include('landing.testimonial.edit-modal')
        @include('landing.testimonial.show')
        @include('landing.testimonial.templates.template')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let profileError = "{{__('messages.testimonial.profile_error')}}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
    </script>
    <script src="{{mix('assets/js/super_admin_testimonial/testimonial.js')}}"></script>
@endsection

