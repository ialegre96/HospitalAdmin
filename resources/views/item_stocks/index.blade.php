@extends('layouts.app')
@section('title')
    {{ __('messages.item_stock.item_stocks') }}
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
                    <a href="{{ route('item.stock.create') }}"
                       class="btn btn-primary">{{ __('messages.item_stock.new_item_stock') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('item_stocks.table')
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
        let itemStockUrl = "{{url('item-stocks')}}";
        let itemStockDownload = "{{url('item-stocks-download')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{ mix('assets/js/item_stocks/item_stocks.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
@endsection
