@extends('landing.layouts.app')
@section('title')
    {{ __('messages.faqs.faqs') }}
@endsection
@section('page_css')
    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <section class="page-title overflow-hidden position-relative text-center text-lg-start" data-bg-color="#d2f9fe">
        <div class="page-title-pattern topBottom"
             data-bg-img="{{asset('assets/landing-theme/images/bg/01.png')}}"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>{{ __('messages.faqs.faqs') }}</span></h1>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">F.A.Q.</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="page-content">

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion" class="accordion">
                            @forelse($faqs as $faq)
                                <div class="card {{$loop->first ? 'active' : ''}}">
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="{{$loop->first ? 'true' : 'false'}}">{{$faq->question}}</a>
                                        </h6>
                                    </div>
                                    <div id="collapse{{$faq->id}}" class="collapse {{$loop->first ? 'show' : ''}}" data-bs-parent="#accordion">
                                        <div class="card-body">{{$faq->answer}}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="text-center empty_featured_card border-0">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <div>
                                                    <div class="empty-featured-portfolio">
                                                        <i class="fas fa-question text-white p-3 theme-bg  display-6 my-2"></i>
                                                    </div>
                                                    <h3 class="card-title mt-3">
                                                        {{__('We couldn\'t find any records')}}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
