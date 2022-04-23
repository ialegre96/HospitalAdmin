@extends('layouts.app')
@section('title')
    {{ __('messages.radiology_category.radiology_categories') }}
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                       data-bs-target="#addModal">{{ __('messages.radiology_category.new_radiology_category') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('radiology_categories.table')
        </div>
        @include('radiology_categories.modal')
        @include('radiology_categories.edit_modal')
        @include('radiology_categories.templates.templates')
    </div>
@endsection

@section('scripts')
    <script>
        let radiologyCategoryCreateUrl = "{{ route('radiology.category.store') }}";
        let radiologyCategoryUrl = "{{ url('radiology-categories') }}";
    </script>
    <script src="{{ mix('assets/js/radiology_categories/radiology_categories.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
