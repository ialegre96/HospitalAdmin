@extends('layouts.app')
@section('title')
    {{ __('messages.pathology_category.pathology_categories') }}
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
                       data-bs-target="#addModal">{{ __('messages.pathology_category.new_pathology_category') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('pathology_categories.table')
        </div>
        @include('pathology_categories.modal')
        @include('pathology_categories.edit_modal')
        @include('pathology_categories.templates.templates')
    </div>
@endsection

@section('scripts')
    <script>
        let pathologyCategoryCreateUrl = "{{ route('pathology.category.store') }}";
        let pathologyCategoryUrl = "{{ url('pathology-categories') }}";
    </script>
    <script src="{{ mix('assets/js/pathology_categories/pathology_categories.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
