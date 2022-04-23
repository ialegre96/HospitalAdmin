@extends('layouts.app')
@section('title')
    {{ __('messages.item.items') }}
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
                    <a href="{{ route('items.create') }}" class="btn btn-primary">{{ __('messages.item.new_item') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('items.table')
            <div class="pull-right mr-3">

            </div>
        </div>
        @include('partials.page.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let itemUrl = "{{url('items')}}";
    </script>
    <script src="{{ mix('assets/js/items/items.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
