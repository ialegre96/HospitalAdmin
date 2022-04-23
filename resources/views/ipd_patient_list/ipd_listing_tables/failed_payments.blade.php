@extends('layouts.app')
@section('title')
    Payment Failed
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row m-5">
            <div class="col-12">
                <div class="d-flex align-items-center alert alert-danger">
                    <span>Sorry! Payment is failed, Try again after some time.</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <a class="btn btn-primary" href="{{ route('patient.ipd') }}">Back</a>
        </div>
    </div>
@endsection
