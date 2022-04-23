@extends('layouts.app')
@section('title')
    {{ __('messages.landing_cms.section_four') }}
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['super.admin.section.four.update'],' method' => 'POST', 'files' => true]) }}
            @method('PUT')
            @include('landing.section_four.field')
            {{ Form::close() }}
        </div>
    </div>
@endsection
