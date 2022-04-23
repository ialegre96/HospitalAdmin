@extends('layouts.app')
@section('title')
    {{ __('messages.document_types') }}
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
                       data-bs-target="#AddModal">{{__('messages.doc_type.new_doc_type')}}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('document_types.table')
        </div>
        @include('document_types.add_modal')
        @include('document_types.edit_modal')
        @include('partials.modal.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let docTypeCreateUrl = "{{route('document-types.store')}}";
        let docTypeUrl = "{{route('document-types.index')}}";
    </script>
    <script src="{{ mix('assets/js/document_type/doc_type.js') }}"></script>
    <script src="{{ mix('assets/js/custom/new-edit-modal-form.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
@endsection

