@extends('layouts.app')
@section('title')
    {{ __('messages.charge_category.charge_category_details')}}
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
                @include('charge_categories.show_fields')
            </div>
        </div>
    </div>
    @include('charge_categories.edit_modal')
@endsection
@section('scripts')
    <script>
        let chargeCategoryUrl = "{{ url('charge-categories') }}";
    </script>
    <script src="{{ mix('assets/js/charge_categories/create-details-edit.js') }}"></script>
@endsection
