@extends('layouts.app')
@section('title')
    {{ __('messages.charge_category.charge_categories') }}
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
                       data-bs-target="#addModal">{{ __('messages.charge_category.new_charge_category') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('charge_categories.table')
        </div>
        @include('charge_categories.templates.templates')
        @include('charge_categories.create_modal')
        @include('charge_categories.edit_modal')
    </div>
@endsection
@section('scripts')
    <script>
        let chargeCategoryUrl = "{{ url('charge-categories') }}";
        let chargeCategoryCreateUrl = "{{ route('charge-categories.store') }}";
    </script>
    <script src="{{mix('assets/js/charge_categories/charge_categories.js')}}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/charge_categories/create-edit.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection

