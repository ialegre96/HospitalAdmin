@extends('errors::minimal')

@section('title')
    {{ __('Forbidden') }}
@endsection
{{--@section('code', '403')--}}
{{--@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}
@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
            <img src="{{ asset('web/img/error.png') }}" class="mw-100 mb-10 h-lg-450px">
            <h1 class="fw-bolder fs-4x text-gray-700 mb-8">
                {{ 403 }}
            </h1>
            <h1 class="fw-bold mb-10">
                {{ __($exception->getMessage() ?: 'Forbidden') }}
            </h1>
            <div class="text-center">
                <a class="btn btn-primary fw-bolder mt-3" href="{{ route('landing.home') }}">Back to Home Page</a>
            </div>
        </div>
    </div>
@endsection
