@extends('layouts.app')
@section('title')
    {{ __('messages.document.document_type_details') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('document_types.show_fields')
            </div>
        </div>
        @include('document_types.edit_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/document_type/user_documents.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let docTypeUrl = "{{route('document-types.index')}}";
    </script>
    <script src="{{ mix('assets/js/document_type/doc_type-details-edit.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
@endsection
