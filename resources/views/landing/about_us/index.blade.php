@extends('layouts.app')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('content')
    @include('flash::message')
    @include('layouts.errors')
    <div class="card">
        <div class="card-body text-gray-700">
            {{ Form::open(['route' => ['super.admin.about.us.update'],' method' => 'POST', 'files' => true]) }}
            @method('PUT')
            @include('landing.about_us.field')
            {{ Form::close() }}
        </div>
    </div>
@endsection
