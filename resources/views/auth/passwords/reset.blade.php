@extends('layouts.auth_app')

@section('title')
    Reset password
@endsection
@section('content')
    <!--begin::Authentication - New password -->
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
    @endphp
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('landing.home') }}" class="mb-12">
                <img alt="Logo" src="{{ asset('hms-saas-logo.png') }}" class="h-45px"/>
            </a>
            <div class="w-lg-550px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" class="form w-100 form-submit" action="{{ url('/password/reset') }}"
                      id="kt_new_password_form">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Setup New Password</h1>
                        <div class="text-gray-400 fw-bold fs-4">Already have reset your password ?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">
                            Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control form-control-lg form-control-solid" name="email"
                               value="{{ old('email') }}" placeholder="" required>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label fw-bolder text-dark fs-6">
                            Password
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="password"
                               placeholder="" required>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">
                            Confirm Password
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation"
                               class="form-control form-control-lg form-control-solid"
                               placeholder="" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_new_password_submit"
                                class="btn btn-lg btn-primary fw-bolder indicator">
                            <span class="indicator-label">Reset</span>
                            <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Authentication - New password-->
@endsection
