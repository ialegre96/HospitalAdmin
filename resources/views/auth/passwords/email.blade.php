@extends('layouts.auth_app')

@section('title')
    Password Reset
@endsection
@section('content')
    @include('flash::message')
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
        $hospitalSettingValue = getSettingValue();
    @endphp
    <!--begin::Authentication - Password reset -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('landing.home') }}" class="mb-12">
                <img alt="Logo" src="{{ $hospitalSettingValue['favicon']['value'] }}" class="h-45px"/>
            </a>
            <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="post" class="form w-100 form-submit" action="{{ url('/password/email') }}">
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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Forgot Password ?</h1>
                        <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">
                            Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control form-control-solid" name="email"
                               value="{{ old('email') }}"
                               placeholder="" required>
                    </div>
                    <div class="d-flex justify-content-center pb-lg-0">
                        <button type="submit" id="kt_password_reset_submit"
                                class="btn btn-lg btn-primary fw-bolder me-4 indicator">
                            <span class="indicator-label">Send Password Reset Link</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Authentication - Password reset-->
@endsection
