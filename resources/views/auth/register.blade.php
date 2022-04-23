@extends('layouts.auth_app')

@section('title')
    Register
@endsection
@section('css')
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">
@endsection
@section('content')
    <!--begin::Authentication - Sign-up -->
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
        $hospitalSettingValue = getSettingValue();
    @endphp
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('landing.home') }}" class="mb-12">
                <img alt="Logo" src="{{ $hospitalSettingValue['favicon']['value'] }}" class="h-45px"/>
            </a>
            <div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                @include('flash::message')
                <form method="post" action="{{ url('/register') }}" class="form w-100 form-submit" id="kt_sign_up_form">
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
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">Hospital Registration</h1>
                        <div class="text-gray-400 fw-bold fs-4">Already have an account?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a></div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Hospital Name:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="hospital_name" value="{{ old('hospital_name') }}"
                                   placeholder="Enter Hospital Name" pattern="^[a-zA-Z0-9 ]+$"
                                   title="Hospital Name Not Allowed Special Character" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Hospital Slug:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="username" value="{{ old('username') }}"
                                   placeholder="Enter Username" pattern="^\S[a-zA-Z0-9]+$"
                                   title="Hospital Slug must be alphanumeric and having exact 12 characters in length"
                                   required
                                   min="12" maxlength="12">
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Email:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg form-control-solid"
                                   name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Phone Number:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="phone" class="form-control form-control-lg form-control-solid"
                                   name="phone" value="{{ old('phone') }}" placeholder="" id="phoneNumber"
                                   onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                                   required maxlength="11">
                            <input type="hidden" name="prefix_code" value="" id="prefix_code">
                            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                    </div>
                    <div class="row mb-7 fv-row" data-kt-password-meter="true">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Password:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="password"
                                       class="form-control form-control-lg form-control-solid"
                                       name="password" placeholder="Enter Password" required>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            </div>
                            <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                        <div class="col-xl-6" data-kt-password-meter="true">
                            <label class="form-label fw-bolder text-dark fs-6">Confirm Password:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation"
                                       class="form-control position-relative form-control-lg form-control-solid"
                                       placeholder="Enter Confirm Password" required>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
                            </div>
                            <div class="d-flex align-items-center my-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2 d-flex justify-content-center">
                            @if(config('app.recaptcha.key'))
                                <div class="form-group mb-4">
                                    <div class="g-recaptcha" data-sitekey="{{config('app.recaptcha.key')}}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_up_submit"
                                class="btn btn-lg btn-primary indicator btn-validate">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Authentication - Sign-up-->
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/int-tel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/int-tel/js/utils.min.js') }}"></script>
    <script>
        let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";
        let isEdit = false;
        let onRegister = true;
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endsection
