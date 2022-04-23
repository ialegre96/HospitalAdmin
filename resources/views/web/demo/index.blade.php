@extends('web.layouts.front')
@section('title')
    Home
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('web/css/animate.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 all-features my-5">
                        <div class="row">
                            <div class="col-12 features-list col-md-8 offset-md-2 col-lg-4 offset-lg-0">
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/super-admin.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">super admin</h6>
                                            <p class="text-muted m-0">Take full control with all feaetures.</p>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/admin.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">admin</h6>
                                            <p class="text-muted m-0">manage day to day activity with almost all features.</p>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/doctor.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">doctor</h6>
                                            <p class="text-muted m-0">Manage patient treatment in OPD, IPD and OT.</p>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/pharmacist.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">pharmacist</h6>
                                            <p class="text-muted m-0">Manage pharmacy sales and madicine stock.</p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-12 features-center-image d-flex justify-content-center align-items-center col-md-8 offset-md-2 col-lg-4 offset-lg-0"><img src="{{ asset('web/img/desktop-screen.png') }}" alt=""></div>
                            <div class="col-12 features-list col-md-8 offset-md-2 col-lg-4 offset-lg-0">
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/pathology.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">pathology</h6>
                                            <p class="text-muted m-0">Manage pathology test & reports.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.6s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/radiology.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">radiology</h6>
                                            <p class="text-muted m-0">Manage radiology test & reports.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/receptionist.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">receptionist</h6>
                                            <p class="text-muted m-0">Manage OPD appointments, visitors, postal & complain.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-item px-2 py-3 mb-3 wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="row no-gutters">
                                        <div class="feature-item-image col-2 text-center d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('web/img/accountant.png') }}">
                                        </div>
                                        <div class="feature-item-content col-10 d-flex flex-column justify-content-center">
                                            <h6 class="m-0">accountant</h6>
                                            <p class="text-muted m-0">Manage OPD, IPD, different departments billing & payroll.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12 all-btns my-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                    <a href="#" class="btn superadmin-login">superadmin login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                    <a href="#" class="btn admin-login">admin login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn doctor-login">doctor login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn accountant-login">accountant login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn receptionist-login">receptionist login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn pharmacist-login">pharmacist login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn pathology-login">phathologist login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn radiologist-login">radiologist login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn patient-login">patient login</a>
                                </div>
                                <div class="col-md-4 col-lg-3 mb-4 col-6">
                                <a href="#" class="btn front-site">front site</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('web/js/wow.min.js') }}"></script>
@endsection
