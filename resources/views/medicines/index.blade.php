@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicines') }}
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
                    @if(Auth::user()->hasRole('Pharmacist'))
                        <a href="#" class="btn btn-primary ps-7 show menu-dropdown" data-kt-menu-trigger="click"
                           data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                           data-kt-menu-flip="bottom">{{ __('messages.common.actions') }}
                            <span class="svg-icon svg-icon-2 me-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <path
                                                                        d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                        </a>
                        <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold py-4 w-200px fs-6"
                                data-kt-menu="true">
                            <div class="menu-item px-5">
                                <a href="{{ route('medicines.create') }}"
                                   class="menu-link px-5">{{ __('messages.medicine.new_medicine') }}</a>
                            </div>
                            <div class="menu-item px-5">
                                <a href="{{ route('medicines.excel') }}"
                                   class="menu-link px-5">{{ __('messages.common.export_to_excel') }}</a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('medicines.create') }}"
                           class="btn btn-primary">{{ __('messages.medicine.new_medicine') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-0 fs-6 py-8 px-8  px-lg-10 text-gray-700">
            @include('medicines.table')
        </div>
        @include('partials.page.templates.templates')
        @include('medicines.show_modal')
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let medicineUrl = "{{route('medicines.index')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{mix('assets/js/medicines/medicines.js')}}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection

