@extends('layouts.app')
@section('title')
    {{ __('messages.bed.new_bulk_bed') }}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                <a href="{{ route('beds.index') }}"
                   class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'store.bulk.beds', 'id' => 'bulkBedsForm']) }}

                    @include('beds.bulk_beds_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('beds.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let bedUrl = "{{route('beds.index')}}";
        let bulkBedSaveUrl = "{{route('store.bulk.beds')}}";
        let bedTypes = JSON.parse('@json($associateBedTypes)');
        let uniqueId = 2;
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{ mix('assets/js/beds/bulk_beds.js') }}"></script>
    <script src="{{ mix('assets/js/beds/create-edit.js') }}"></script>
@endsection
