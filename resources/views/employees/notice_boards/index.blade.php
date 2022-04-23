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
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('employees.notice_boards.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let noticeBoardUrl = "{{url('employee/notice-board')}}";
        let noticeBoardShowUrl = "{{url('employee/notice-board')}}";
    </script>
    <script src="{{ mix('assets/js/employee/notice_boards.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
