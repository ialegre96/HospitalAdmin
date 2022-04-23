@extends('layouts.auth_app')

@section('title')
    Login
@endsection
@section('content')

    <!--begin::Authentication - Sign-in -->
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
        $settingValue = getSuperAdminSettingValue();
    @endphp
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('landing.home') }}" class="mb-12">
                <img alt="Logo" src="{{ asset($settingValue['app_logo']['value']) }}" class="h-45px"/>
            </a>
            <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="post" class="form w-100 form-submit" action="{{ url('/login') }}" id="kt_sign_in_form">
                    @include('flash::message')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="route_name"
                           value="{{ app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() }}">
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Sign In</h1>
                        <div class="text-gray-400 fw-bold fs-4">New Here?
                            <a href="{{ route('register')  }}" class="link-primary fw-bolder">Create an Account</a>
                        </div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">
                            Email: <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control form-control-lg form-control-solid" name="email"
                               placeholder="Enter Email"
                               value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                               required>
                    </div>
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">
                                Password: <span class="text-danger">*</span>
                            </label>
                            <a href="{{ url('/password/reset') }}" class="link-primary fs-6 fw-bolder">Forgot Password
                                ?</a>
                        </div>
                        <input type="password"
                               class="form-control form-control-lg form-control-solid" name="password"
                               placeholder="Enter Password"
                               value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                               required>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-check form-check-custom form-check-solid form-check-inline"
                               for="remember_me">
                            <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                            <span class="form-check-label fw-bold text-gray-700 fs-6">Remember me</span>
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit"
                                class="btn btn-lg btn-primary w-100 mb-5 indicator">
                            <span class="indicator-label">Login</span>
                            <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Authentication - Sign-in -->
@endsection
