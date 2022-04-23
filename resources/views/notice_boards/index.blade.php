@extends('layouts.app')
@section('title')
    {{ __('messages.notice_boards') }}
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                       data-bs-target="#addModal">{{ __('messages.notice_board.new') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('notice_boards.table')
        </div>
        @include('notice_boards.create_modal')
        @include('notice_boards.edit_modal')
        @include('notice_boards.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let noticeBoardUrl = "{{url('notice-boards')}}";
        let noticeBoardCreateUrl = "{{route('notice-boards.store')}}";
    </script>
    <script src="{{ mix('assets/js/notice_boards/notice_boards.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/notice_boards/create-edit.js') }}"></script>
@endsection
