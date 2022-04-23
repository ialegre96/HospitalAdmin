@extends('layouts.app')
@section('title')
    {{ __('messages.mail') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-body pt-0 fs-6 py-8 px-8 px-lg-10 text-gray-700">
            {{ Form::open(['route' => 'mail.send', 'files' => 'true']) }}
            @include('mail.fields')
            {{ Form::close() }}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
    </script>
    <script src="{{ mix('assets/js/mail/mail.js') }}"></script>
@endsection
