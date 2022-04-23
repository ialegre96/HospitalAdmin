@extends('layouts.app')
@section('title')
    {{ __('messages.bed.bed_details') }}
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
                @include('beds.show_fields')
            </div>
        </div>
        @include('beds.edit_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/beds/beds_assigns_view_list.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let bedUrl = "{{url('beds')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{ mix('assets/js/beds/beds-details-edit.js') }}"></script>
@endsection
