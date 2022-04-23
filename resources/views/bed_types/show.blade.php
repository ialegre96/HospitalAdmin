@extends('layouts.app')
@section('title')
    {{ __('messages.bed_type.bed_type_details')}}
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
                @include('bed_types.show_fields')
                </div>
            </div>
            @include('bed_types.edit_modal')
        </div>
    @endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/bed_types/beds_view_list.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let bedTypesUrl = "{{ url('bed-types') }}";
    </script>
    <script src="{{ mix('assets/js/bed_types/bed_types_details_edit.js') }}"></script>
@endsection
