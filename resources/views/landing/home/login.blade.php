@extends('landing.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <section class="page-title overflow-hidden position-relative text-center text-lg-start" data-bg-color="#d2f9fe">
        <div class="page-title-pattern topBottom"
             data-bg-img="{{asset('assets/landing-theme/images/bg/01.png')}}"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>Login</span> Now</h1>
                    <p>We're Build With Latest And Modern Code</p>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">Pages
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">

        <section>
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-4 col-md-12 ms-auto dark-bg px-4 align-item-middle text-center radius">
                        <div>
                            <div class="section-title text-white">
                                <h2 class="title">Sign In</h2>
                                <div class="title-bdr">
                                    <div class="left-bdr"></div>
                                    <div class="right-bdr"></div>
                                </div>
                                <p>Welcome To Sassaht, Please Enter Your Details And Start Journy With Sassaht</p>
                            </div>
                            <h5 class="mb-0 mt-4 text-capitalize text-white">Don't Have An Account ? <br> <a
                                        href="#">Sign Up!</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 me-auto mt-5 mt-lg-0">
                        <div class="login-form text-center white-bg box-shadow radius px-5 py-5">
                            <div class="social-icons social-colored">
                                <ul class="list-inline">
                                    <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="social-dribbble"><a href="#"><i class="fab fa-dribbble"></i></a>
                                    </li>
                                    <li class="social-skype"><a href="#"><i class="fab fa-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <p class="my-3 font-italic">Or Use You Email Account</p>
                            <form id="contact-form" method="post" action="php/contact.php">
                                <div class="messages"></div>
                                <div class="form-group">
                                    <input id="form_name" type="text" name="name" class="form-control"
                                           placeholder="User name" required="required"
                                           data-error="Username is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input id="form_password" type="password" name="password" class="form-control"
                                           placeholder="Password" required="required"
                                           data-error="password is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group mt-4 mb-5">
                                    <div class="remember-checkbox d-flex align-items-center justify-content-between">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckChecked" checked>
                                            <label class="form-check-label" for="flexCheckChecked">Remember me</label>
                                        </div>
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-theme text-uppercase"><span>Sign In</span></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
