@extends('layouts.app')
@section('title')
    {{ __('messages.roles') }}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="page-header">
                <h3 class="page__heading">{{ __('messages.roles') }}</h3>
                <div class="filter-container">
                    <div class="mr-2">
                        <label for="filter_active" class="lbl-block"><b>{{ __('messages.common.active') }}</b></label>
                        {{ Form::select('is_active',$activeArr,null,['id'=>'filter_active','class'=>'form-control status-filter']) }}
                    </div>
                    <a href="#" class="btn btn-primary filter-container__btn" data-toggle="modal"
                       data-target="#AddModal">
                        {{ __('messages.role.new_role') }}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('departments.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('departments.add_modal')
        @include('departments.edit_modal')
        @include('departments.templates.templates')
    </div>
@endsection
@section('page_scripts')
    {{-- Both JS need for load datatble --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.toast.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let departmentCreateUrl = "{{route('departments.store')}}";
        let departmentUrl = "{{route('departments.index')}}/";
    </script>
    <script src="{{mix('assets/js/departments/departments.js')}}"></script>
    <script src="{{mix('assets/js/custom/new-edit-modal-form.js')}}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
@endsection

