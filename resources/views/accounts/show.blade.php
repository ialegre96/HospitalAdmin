@extends('layouts.app')
@section('title')
    {{ __('messages.account.account_details')}}
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
                @include('accounts.show_fields')
                </div>
                @include('accounts.edit_modal')
            </div>
        </div>
    @endsection
@section('scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/accounts/payments_list.js') }}"></script>
    <script>
        let accountUrl = "{{route('accounts.index')}}";
    </script>
    <script src="{{ mix('assets/js/accounts/accounts_details_edit.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
@endsection
