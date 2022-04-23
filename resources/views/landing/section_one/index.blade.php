@extends('layouts.app')
@section('title')
    {{ __('messages.landing_cms.section_one') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['super.admin.section.one.update'], 'id' => 'sectionOneForm','method' => 'put', 'files' => true]) }}
            @include('landing.section_one.field')
            {{ Form::close() }}
        </div>
    </div>
@endsection
