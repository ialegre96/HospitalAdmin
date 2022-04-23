@extends('layouts.app')
@section('title')
    {{ __('messages.bed_type.bed_types') }}
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
                       class="btn btn-primary">{{ __('messages.bed_type.new_bed_type') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('bed_types.table')
        </div>
        @include('bed_types.modal')
        @include('bed_types.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let bedTypesCreateUrl = "{{ route('bed-types.store') }}";
        let bedTypesUrl = "{{ url('bed-types') }}";
    </script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/bed_types/bed_types.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
