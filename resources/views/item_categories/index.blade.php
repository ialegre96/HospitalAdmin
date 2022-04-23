@extends('layouts.app')
@section('title')
    {{ __('messages.item_category.item_categories') }}
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
                       data-bs-target="#addModal">{{ __('messages.item_category.new_item_category') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('item_categories.table')
        </div>
        @include('item_categories.modal')
        @include('item_categories.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let itemCategoryCreateUrl = "{{ route('item-categories.store') }}";
        let itemCategoriesUrl = "{{ url('item-categories') }}";
    </script>
    <script src="{{ mix('assets/js/item_categories/item_categories.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
