@extends('layouts.app')
@section('title')
    {{ __('messages.landing_cms.section_two') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['super.admin.section.two.update'],' method' => 'POST', 'files' => true]) }}
            @method('PUT')
            @include('landing.section_two.field')
            {{ Form::close() }}
        </div>
    </div>
@endsection
