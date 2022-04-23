@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.ipd_patient_details') }}
@endsection

@section('page_css')
@endsection

@section('css')
    <link href="{{ asset('assets/css/timeline.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('header_toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                    <a href="{{ route('ipd.patient.edit',['ipdPatientDepartment' => $ipdPatientDepartment->id]) }}"
                       class="btn btn-sm btn-primary me-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ url()->previous() }}"
                   class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                <div class="p-12">
                            @include('ipd_patient_departments.show_fields')
                        </div>
                    </div>
    @include('ipd_diagnoses.add_modal')
    @include('ipd_diagnoses.edit_modal')
    @include('ipd_consultant_registers.add_modal')
    @include('ipd_consultant_registers.edit_modal')
    @include('ipd_charges.add_modal')
    @include('ipd_charges.edit_modal')
    @include('ipd_prescriptions.add_modal')
    @include('ipd_prescriptions.edit_modal')
    @include('ipd_prescriptions.show_modal')
    @include('ipd_timelines.add_modal')
    @include('ipd_timelines.edit_modal')
    @include('ipd_diagnoses.templates.templates')
    @include('ipd_consultant_registers.templates.templates')
    @include('ipd_charges.templates.templates')
    @include('ipd_prescriptions.templates.templates')
    @include('ipd_payments.add_modal')
    @include('ipd_payments.edit_modal')
    @include('ipd_payments.templates.templates')
    </div>
@endsection
@section('page_scripts')
{{--    <script src="{{ asset('assets/js/moment.min.js') }}"></script>--}}
@endsection
@section('scripts')
    <script>
        let ipdDiagnosisCreateUrl = "{{route('ipd.diagnosis.store')}}";
        let ipdDiagnosisUrl = "{{route('ipd.diagnosis.index')}}";
        let ipdConsultantRegisterUrl = "{{route('ipd.consultant.index')}}";
        let ipdConsultantRegisterCreateUrl = "{{route('ipd.consultant.store')}}";
        let ipdChargesUrl = "{{route('ipd.charge.index')}}";
        let ipdChargesCreateUrl = "{{route('ipd.charge.store')}}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/default_image.jpg') }}";
        let ipdPatientDepartmentId = "{{ $ipdPatientDepartment->id }}";
        let ipdPatientCaseDate = "{{ $ipdPatientDepartment->patientCase->date }}";

        let doctorUrl = "{{url('doctors')}}";
        let doctors = JSON.parse('@json($doctorsList)');
        let uniqueId = 2;
        let chargeCategoryUrl = "{{ route('charge.category.list') }}";
        let chargeUrl = "{{ route('charge.list') }}";
        let chargeStandardRateUrl = "{{ route('charge.standard.rate') }}";
        let ipdPrescriptionUrl = "{{route('ipd.prescription.index')}}";
        let ipdPrescriptionCreateUrl = "{{route('ipd.prescription.store')}}";
        let medicineCategories = JSON.parse('@json($medicineCategoriesList)');
        let medicinesListUrl = "{{ route('medicine.list') }}";
        let ipdTimelineCreateUrl = "{{route('ipd.timelines.store')}}";
        let ipdTimelinesUrl = "{{route('ipd.timelines.index')}}";
        let ipdPaymentCreateUrl = "{{route('ipd.payments.store')}}";
        let ipdPaymentUrl = "{{route('ipd.payments.index')}}";
        let ipdPaymentModes = JSON.parse('@json($paymentModes)');
        let ipdBillSaveUrl = "{{ route('ipd.bills.store') }}";
        let downloadDiagnosisDocumentUrl = "{{ url('ipd-diagnosis-download') }}";
        let downloadPaymetDocumentUrl = "{{ url('ipd-payment-download') }}";
        let downloadTimelineDocumentUrl = "{{ url('ipd-timeline-download') }}";
        let isEditBill = "@if($ipdPatientDepartment->bill) {{ 1 }} @endif";
        let bootstarpUrl = "{{ asset('assets/css/bootstrap.min.css') }}";
        let billstaus = "{{$ipdPatientDepartment->bill_status}}";
        let actionAcoumnVisibal = "{{ ($ipdPatientDepartment->bill_status) ? false : true }}";

        $(document).on('click', '#IPDtab a', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        // store the currently selected tab in the hash value
        $('ul.nav-tabs > li > a').on('shown.bs.tab', function (e) {
            var id = $(e.target).attr('href').substr(1);
            window.location.hash = id;
        });
        // on load of the page: switch to the currently selected tab
        // var hash = window.location.hash;
        // $('#IPDtab a[href="' + hash + '"]').tab('show');
    </script>
    <script src="{{ mix('assets/js/ipd_diagnosis/ipd_diagnosis.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_consultant_register/ipd_consultant_register.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_charges/ipd_charges.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_prescriptions/ipd_prescriptions.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_timelines/ipd_timelines.js') }}"></script>
    <script src="{{ mix('assets/js/custom/new-edit-modal-form.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_payments/ipd_payments.js') }}"></script>
    <script src="{{ mix('assets/js/ipd_bills/ipd_bills.js') }}"></script>
    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>
    <script src="{{ mix('assets/js/custom/reset_models.js') }}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
@endsection
