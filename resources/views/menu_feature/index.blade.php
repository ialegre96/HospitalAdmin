@extends('layouts.app')
@section('title')
    Feature Availability
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                        
                        <span class="svg-icon svg-icon-5tx svg-icon-danger mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                                      fill="black"></rect>
                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                                      fill="black"></rect>
                            </svg>
                        </span>

                        <div class="text-center">
                            <h1 class="fw-bolder mb-5">Access Denied!</h1>

                            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>

                            <div class="mb-9 text-dark">
                                Opps, the requested feature is not available within your hospital.
                            </div>

                            <div class="d-flex flex-center flex-wrap">
                                @if(getLoggedInUser()->hasRole('Admin'))
                                    <a href="{{ route('dashboard') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.dashboard.dashboard') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Doctor'))
                                    <a href="{{ route('doctor') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.doctors') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Accountant'))
                                    <a href="{{ route('accounts.index') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.account_manager') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Case Manager'))
                                    <a href="{{ route('doctor') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.doctors') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Receptionist'))
                                    <a href="{{ route('appointments.index') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.appointments') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Pharmacist'))
                                    <a href="{{ route('doctor') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.doctors') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Lab Technician'))
                                    <a href="{{ route('doctor') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.doctors') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Nurse'))
                                    <a href="{{ route('bed-types.index') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.bed_management') }}
                                    </a>
                                @elseif(getLoggedInUser()->hasRole('Patient'))
                                    <a href="{{ route('patients.cases') }}"
                                       class="btn btn-outline btn-outline-primary btn-active-primary m-2">
                                        Go To {{ __('messages.patients_cases') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
