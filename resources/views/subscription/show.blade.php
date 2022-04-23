@extends('layouts.app')
@section('title')
    {{ __('messages.subscription.subscription_details') }}
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            @include('subscription.show_fields')
        </div>
    </div>
@endsection
