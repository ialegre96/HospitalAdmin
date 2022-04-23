@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard.dashboard') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/daterangepicker.css') }}">
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row g-5 gx-xxl-8">
                <div class="col-xl-3 col-md-6">
                    <a href="{{route('super.admin.hospitals.index') }}"
                       class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body card-1">
                            <span class="rotate"><i
                                        class="fas fa-hospital fa-4x display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">
                                {{$data['users']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{ __('messages.dashboard.total_hospitals') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('subscriptions.transactions.index') }}"
                       class="card bg-info hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body card-1">
                            <span class="rotate"><i class="fas fa-rupee-sign fa-4x display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">
                                {{number_format($data['revenue'], 2)}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{ __('messages.dashboard.total_revenue') }}</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('super.admin.subscription.plans.index') }}"
                       class="card bg-success hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body card-1">
                            <span class="rotate"><i
                                        class="fas fa-toggle-on fa-4x display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">
                                {{$data['activeHospitalPlan']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{ __('messages.dashboard.total_active_hospital_plan') }}</div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ route('super.admin.subscription.plans.index') }}"
                       class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <div class="card-body card-1">
                            <span class="rotate"><i
                                        class="fas fa-toggle-off fa-4x display-4 card-icon text-white"></i></span>
                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">
                                {{ $data['deActiveHospitalPlan']}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">{{ __('messages.dashboard.total_expired_hospital_plan') }}</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row g-5  mt-4">
                <div class="col-lg-12 col-xl-3 col-md-12 col-sm-12">
                    <h1 class="text-dark">{{ __('messages.dashboard.income_report') }}</h1>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 ms-auto">
                    <div class="form-group mb-3 d-flex">
                        <a href="javascript:void(0)" class="btn btn-light fw-bolder me-5 ps-3 pe-2 bg-secondary" title="Switch Chart">
                                    <span class="svg-icon svg-icon-1 m-0 text-center" id="changeChart">
                                        <i class="fas fa-chart-bar fs-1 fw-boldest chart"></i>
                                    </span>
                        </a>
                        <input class="form-control form-control-solid bg-secondary" autocomplete="off"
                               placeholder="{{ __('Please Select Rang Picker') }}" id="chartFilter"/>
                    </div>
                </div>
            </div>
            <div class="row g-5 gx-xxl-8">
                <div id="hospitalIncomeChart"></div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/plugins/daterangepicker.js') }}"></script>
    <script src="{{ mix('assets/js/super_admin/dashboard/dashboard.js') }}"></script>
@endsection
