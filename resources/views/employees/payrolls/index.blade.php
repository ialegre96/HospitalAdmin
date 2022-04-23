@extends('layouts.app')
@section('title')
    {{ __('messages.my_payroll.my_payrolls') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">
@endsection
@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header border-0 pt-6">
            @include('layouts.search-component')
            <div class="card-toolbar">
                <div class="d-flex align-items-center py-1">
                    <a href="{{ route('my.payrolls.excel') }}"
                       class="btn btn-primary">{{ __('messages.common.export_to_excel') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body fs-6 py-8 px-8 py-lg-10 px-lg-10 text-gray-700">
            @include('employees.payrolls.table')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let employeePayrollUrl = "{{url('employee/payroll')}}";
        let payrollUrl = "{{url('employee-payrolls')}}";
    </script>
    <script src="{{ mix('assets/js/custom/input_price_format.js') }}"></script>
    <script src="{{ mix('assets/js/employee/my_payrolls.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
