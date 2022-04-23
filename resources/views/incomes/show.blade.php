@extends('layouts.app')
@section('title')
    {{ __('messages.incomes.income_details')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            @include('layouts.errors')
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                <a data-id="{{ $incomes->id }}" class="btn btn-sm btn-primary me-2 edit-btn">{{ __('messages.common.edit') }}</a>
                <a href="{{route('incomes.index')}}"
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
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('incomes.show_fields')
            </div>
        </div>
    </div>
    @include('incomes.edit_modal')
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let incomeUrl = "{{url('incomes')}}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
        let download = '{{__('messages.incomes.download')}}';
        let documentError = "{{__('messages.incomes.document_error')}}";
    </script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{mix('assets/js/incomes/incomes-details-edit.js')}}"></script>
@endsection
