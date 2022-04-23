@extends('layouts.app')
@section('title')
    {{ __('messages.bill.bills') }}
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
                    <a href="{{ route('bills.create') }}" class="btn btn-primary">{{__('messages.bill.new_bill')}}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('bills.table')
        </div>
        @include('bills.templates.templates')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let billUrl = "{{route('bills.index')}}";
        let patientUrl = "{{url('patients')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{mix('assets/js/bills/bill.js')}}"></script>
    <script src="{{mix('assets/js/custom/new-edit-modal-form.js')}}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
@endsection
