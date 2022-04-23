@extends('layouts.app')
@section('title')
    {{ __('messages.hospital_details') }}
@endsection
@section('page_css')
    {{--    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
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
                <a href="{{route('hospital.edit',['hospital' => $users['hospital']->id]) }}"
                   class="btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ url()->previous() }}"
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
                @include('super_admin.users.show_fields')
            </div>
        </div>
        @include('super_admin.users.billing_modal')
    </div>
@endsection
@section('page_scripts')
    {{--    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    <script type="text/javascript">
        let userUrl = "{{ route('super.admin.hospitals.index') }}";
        let showUrl = "{{ route('super.admin.hospitals.datatable.index') }}";
        let billingUrl = "{{ route('super.admin.hospital.billing.index') }}";
        let transactionUrl = "{{ route('super.admin.hospital.transaction.index') }}";
        let stripe = "{{ \App\Models\Subscription::PAYMENT_TYPES[1] }}";
        let paypal = "{{ \App\Models\Subscription::PAYMENT_TYPES[2] }}";
        let razorPay = "{{ \App\Models\Subscription::PAYMENT_TYPES[3] }}";
        let cash = "{{ \App\Models\Subscription::PAYMENT_TYPES[4] }}";
        let active = "{{ \App\Models\Subscription::STATUS_ARR[1] }}";
        let deactive = "{{ \App\Models\Subscription::STATUS_ARR[0] }}";
        let month = "{{ \App\Models\Subscription::MONTH }}";
        let year = "{{ \App\Models\Subscription::YEAR }}";
        let paid = "{{ \App\Models\Transaction::PAID }}";
        let unpaid = "{{ \App\Models\Transaction::UNPAID }}";
    </script>
    <script src="{{mix('assets/js/super_admin/users/hospitals_data_listing.js')}}"></script>
    <script src="{{mix('assets/js/super_admin/users/billing.js')}}"></script>
    <script src="{{mix('assets/js/super_admin/users/transaction.js')}}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
