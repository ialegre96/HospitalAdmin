@extends('layouts.app')
@section('title')
    {{ __('messages.faqs.faqs') }}
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">{{ __('messages.faqs.add_faqs') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('landing.faqs.table')
        </div>
    </div>
    @include('landing.faqs.create-modal')
    @include('landing.faqs.edit-modal')
    @include('landing.faqs.show')
    @include('landing.faqs.templates.templates')
@endsection
@section('scripts')
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/faqs/faqs.js')}}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
@endsection
