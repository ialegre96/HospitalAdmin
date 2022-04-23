@extends('layouts.app')
@section('title')
    {{ __('messages.diagnosis_category.diagnosis_categories') }}
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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addModal"
                       class="btn btn-primary">{{ __('messages.diagnosis_category.new_diagnosis_category') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('diagnosis_categories.table')
        </div>
        @include('diagnosis_categories.modal')
        @include('diagnosis_categories.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let diagnosisCategoryCreateUrl = "{{ route('diagnosis.category.store') }}";
        let diagnosisCategoryUrl = "{{ url('diagnosis-categories') }}";
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/diagnosis_category/diagnosis_category.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
