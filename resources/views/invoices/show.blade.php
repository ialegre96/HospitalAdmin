@extends('layouts.app')
@section('title')
    {{ __('messages.invoice.invoice_details')}}
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                    <a href="{{ route('invoices.edit', ['invoice' => $invoice->id]) }}" class="btn btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-lg-20">
            <div class="d-flex flex-column flex-xl-row">
                @include('invoices.show_fields')
            </div>
        </div>
    </div>
@endsection
