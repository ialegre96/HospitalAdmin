@extends('layouts.app')
@section('title')
    {{ __('messages.documents') }}
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
                       data-bs-target="#addModal">{{__('messages.document.new_document')}}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('documents.table')
        </div>
        @include('documents.add_modal')
        @include('documents.edit_modal')
        @include('documents.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let documentsCreateUrl = "{{route('documents.store')}}";
        let documentsUrl = "{{route('documents.index')}}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
        let downloadDocumentUrl = "{{ url('document-download') }}";
        let patientUrl = "{{ route('patients.index') }}";
    </script>
    <script src="{{ mix('assets/js/document/document.js') }}"></script>
    <script src="{{ mix('assets/js/custom/new-edit-modal-form.js') }}"></script>
@endsection
