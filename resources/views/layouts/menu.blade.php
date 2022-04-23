@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())
<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">
    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223"
                                                                      width="8.15546" height="2" rx="1"
                                                                      transform="rotate(45 17.0365 15.1223)"
                                                                      fill="black"></rect>
                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                      fill="black"></path>
                                                            </svg>
                                                        </span>
    <?php
    $style = 'style=';
    $background = 'background-color:';
    $border = 'border:';
    $color = 'color:';
    ?>

    <input type="text" class="form-control form-control-lg form-control-solid ps-15" id="menuSearch" name="search"
           value="" placeholder="Search" autocomplete="off" {{$style}}"{{$background}} #2A2B3A;{{$border}}
    none;{{$color}} #FFFFFF;">
</div>
<div class="no-record text-white text-center d-none">No matching records found</div>
@role('Admin')
{{--Dashboard--}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa-chart-pie"></i>
		</span>
        <span class="menu-title">{{ __('messages.dashboard.dashboard') }}</span>
    </a>
</div>

{{--Accountantants--}}
@module('Accountants',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('accountants*') ? 'active' : '' }}"
           href="{{ route('accountants.index') }}">
            <span class="menu-icon"><i class="fas fa-file-invoice"></i></span>
            <span class="menu-title">{{ __('messages.accountants') }}</span>
        </a>
    </div>
@endmodule

{{--Appointments--}}
@module('Appointments',$modules)
@if(isFeatureAllowToUse('appointments.index'))
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('appointment*') ? 'active' : '' }}"
           href="{{ route('appointments.index') }}">
            <span class="menu-icon"><i class="fas fa-calendar-check"></i></span>
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
@endif
@endmodule

{{-- Billing --}}
<?php
$billingMGT = getMenuLinks(\App\Models\User::MAIN_BILLING_MGT)
?>
@if ($billingMGT)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('accounts*','employee-payrolls*','invoices*','payments*','payment-reports*','advanced-payments*','bills*') ? 'active' : '' }}"
           href="{{ $billingMGT }}">
            <span class="menu-icon"><i class="fas fa-file-invoice-dollar"></i></span>
            <span class="menu-title">{{ __('messages.billing') }}</span>
            <span class="d-none">{{__('messages.employee_payrolls')}}</span>
            <span class="d-none">{{__('messages.invoices')}}</span>
            <span class="d-none">{{__('messages.payments')}}</span>
            <span class="d-none">{{__('messages.payment_reports')}}</span>
            <span class="d-none">{{__('messages.advanced_payments')}}</span>
            <span class="d-none">{{__('messages.bills')}}</span>
        </a>
    </div>
@endif

<?php
$bedMGT = getMenuLinks(\App\Models\User::MAIN_BED_MGT)
?>
@if ($bedMGT)
    {{-- Bed Management  --}}
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('bed-types*','beds*','bed-assigns*','bulk-beds','bed-status') ? 'active' : '' }}"
           href="{{ $bedMGT }}">
            <span class="menu-icon"><i class="fas fa-bed"></i></span>
            <span class="menu-title">{{ __('messages.bed_management') }}</span>
            <span class="d-none">{{__('messages.bed_types')}}</span>
            <span class="d-none">{{__('messages.beds')}}</span>
            <span class="d-none">{{__('messages.bed_assigns')}}</span>
        </a>
    </div>
@endif

{{-- Blood Bank dropdown --}}
@if(isFeatureAllowToUse('blood-banks.index'))
    {{-- Blood Bank dropdown --}}
    <?php
    $bloodbankMGT = getMenuLinks(\App\Models\User::MAIN_BLOOD_BANK_MGT)
    ?>
    @if ($bloodbankMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('blood-banks*','blood-donors*','blood-donations*','blood-issues*') ? 'active' : '' }}"
               href="{{ $bloodbankMGT }}">
                <span class="menu-icon"><i class="fas fa-tint"></i></span>
                <span class="menu-title">{{ __('messages.blood_bank') }}</span>
                <span class="d-none">{{__('messages.blood_donors')}}</span>
                <span class="d-none">{{__('messages.blood_donations')}}</span>
                <span class="d-none">{{__('messages.blood_issues')}}</span>
            </a>
        </div>
    @endif

@endif

{{--Documents Mgt--}}
@if(isFeatureAllowToUse('documents.index'))
    <?php
    $documentMGT = getMenuLinks(\App\Models\User::MAIN_DOCUMENT)
    ?>
    @if ($documentMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('documents*','document-types*') ? 'active' : '' }}"
               href="{{ $documentMGT }}">
                <span class="menu-icon"><i class="fas fa-file"></i></span>
                <span class="menu-title">{{ __('messages.documents') }}</span>
                <span class="d-none">{{__('messages.document_types')}}</span>
            </a>
        </div>
    @endif

@endif

{{-- Doctors dropdown --}}
<?php
$doctorMGT = getMenuLinks(\App\Models\User::MAIN_DOCTOR)
?>
@if ($doctorMGT)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('doctors*','doctor-departments*','schedules*','prescriptions*') ? 'active' : '' }}"
           href="{{ $doctorMGT }}">
            <span class="menu-icon"><i class="fa fa-user-md"></i></span>
            <span class="menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.doctor_departments')}}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </div>
@endif

{{--Diagnosis Test--}}
<?php
$diagnosisMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
?>
@if ($diagnosisMGT)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}"
           href="{{ $diagnosisMGT }}">
            <span class="menu-icon"><i class="fas fa-diagnoses"></i></span>
            <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </div>
@endif

{{-- Enquiries --}}
@module('Enquires',$modules)
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : '' }}"
       href="{{ route('enquiries') }}">
        <span class="menu-icon"><i class="fas fa-question-circle"></i></span>
        <span class="menu-title">{{ __('messages.enquiries') }}</span>
    </a>
</div>
@endmodule

{{-- Finance --}}
<?php
$financeMGT = getMenuLinks(\App\Models\User::MAIN_FINANCE)
?>
@if ($financeMGT)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('incomes*','expenses*') ? 'active' : '' }}"
           href="{{ $financeMGT }}">
            <span class="menu-icon"><i class="fas fa-money-bill"></i></span>
            <span class="menu-title">{{__('messages.finance')}}</span>
            <span class="d-none">{{ __('messages.incomes.incomes') }}</span>
            <span class="d-none">{{ __('messages.expenses') }}</span>
        </a>
    </div>
@endif

{{-- Front office --}}
<?php
$frontOfficeMGT = getMenuLinks(\App\Models\User::MAIN_FRONT_OFFICE)
?>
@if ($frontOfficeMGT)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('call-logs*','visitor*','receives*','dispatches*') ? 'active' : '' }}"
           href="{{ $frontOfficeMGT }}">
            <span class="menu-icon"><i class="fa fa-dungeon"></i></span>
            <span class="menu-title">{{ __('messages.front_office') }}</span>
            <span class="d-none">{{ __('messages.call_logs') }}</span>
            <span class="d-none">{{ __('messages.visitors') }}</span>
            <span class="d-none">{{ __('messages.postal_receive') }}</span>
            <span class="d-none">{{ __('messages.postal_dispatch') }}</span>
        </a>
    </div>
@endif

{{-- Front settings --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*') ? 'active' : '' }}"
       href="{{ route('front.settings.index') }}">
        <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
        <span class="menu-title">{{ __('messages.front_cms') }}</span>
        <span class="d-none">{{ __('messages.notice_boards') }}</span>
        <span class="d-none">{{ __('messages.testimonials') }}</span>
        <span class="d-none">{{ __('messages.cms') }}</span>
        <span class="d-none">{{ __('messages.front_cms_services') }}</span>
    </a>
</div>

{{-- Hospital Charges --}}
<?php
$hospitalCharge = getMenuLinks(\App\Models\User::MAIN_HOSPITAL_CHARGE)
?>
@if ($hospitalCharge)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('charge-categories*','charges*','doctor-opd-charges*') ? 'active' : '' }}"
           href="{{ $hospitalCharge }}">
            <span class="menu-icon"><i class="fas fa-coins"></i></span>
            <span class="menu-title">{{ __('messages.hospital_charges') }}</span>
            <span class="d-none">{{ __('messages.charge_categories') }}</span>
            <span class="d-none">{{ __('messages.charges') }}</span>
            <span class="d-none">{{ __('messages.doctor_opd_charges') }}</span>
        </a>
    </div>
@endif

{{--ipds/opds--}}
<?php
$ipdOPD = getMenuLinks(\App\Models\User::MAIN_IPD_OPD)
?>
@if ($ipdOPD)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('ipds*','opds*') ? 'active' : '' }}" href="{{ $ipdOPD }}"
           title="{{ __('messages.ipd_opd') }}">
        <span class="menu-icon">
            <i class="fas fa-notes-medical"></i>
        </span>
            <span class="menu-title">{{ __('messages.ipd_opd') }}</span>
            <span class="d-none">{{__('messages.ipd_patients')}}</span>
            <span class="d-none">{{__('messages.opd_patients')}}</span>
        </a>
    </div>
@endif

{{-- Inventory Management  --}}
@if(isFeatureAllowToUse('item-categories.index'))
    <?php
    $inventoryMgt = getMenuLinks(\App\Models\User::MAIN_INVENTORY)
    ?>
    @if ($inventoryMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('item-categories*','items*','item-stocks*','issued-items*') ? 'active' : '' }}"
               href="{{ $inventoryMgt }}">
                <span class="menu-icon"><i class="fas fa-luggage-cart"></i></span>
                <span class="menu-title">{{ __('messages.inventory') }}</span>
                <span class="d-none">{{ __('messages.items_categories') }}</span>
                <span class="d-none">{{ __('messages.items') }}</span>
                <span class="d-none">{{ __('messages.items_stocks') }}</span>
                <span class="d-none">{{ __('messages.issued_items') }}</span>
            </a>
        </div>
    @endif
@endif

{{--Lab Technician--}}
@module('Lab Technicians',$modules)
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('lab-technicians*') ? 'active' : '' }}"
       href="{{ route('lab-technicians.index') }}">
        <span class="menu-icon"><i class="fas fa-microscope"></i></span>
        <span class="menu-title">{{ __('messages.lab_technicians') }}</span>
    </a>
</div>
@endmodule

{{-- Live Consultation --}}
@if(isFeatureAllowToUse('live.consultation.index'))
    <?php
    $liveConsultation = getMenuLinks(\App\Models\User::MAIN_LIVE_CONSULATION)
    ?>
    @if ($liveConsultation)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-consultation*','live-meeting*') ? 'active' : '' }}"
               href="{{ $liveConsultation }}">
                <span class="menu-icon"><i class="fa fa-video"></i></span>
                <span class="menu-title">{{ __('messages.live_consultations') }}</span>
                <span class="d-none">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
@endif

{{-- Medicines dropdown --}}
<?php
$medicineMgt = getMenuLinks(\App\Models\User::MAIN_MEDICINES)
?>
@if ($medicineMgt)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('categories*','brands*','medicines*') ? 'active' : '' }}"
           href="{{ $medicineMgt }}">
            <span class="menu-icon"><i class="fas fa-capsules"></i></span>
            <span class="menu-title">{{ __('messages.medicines') }}</span>
            <span class="d-none">{{__('messages.medicine_categories')}}</span>
            <span class="d-none">{{__('messages.medicine_brands')}}</span>
            <span class="d-none">{{__('messages.medicines')}}</span>
        </a>
    </div>
@endif

{{--Nursers--}}
@module('Nurses',$modules)
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('nurses*') ? 'active' : '' }}"
       href="{{ route('nurses.index') }}">
        <span class="menu-icon"><i class="fa fa-user-nurse"></i></span>
        <span class="menu-title">{{ __('messages.nurses') }}</span>
    </a>
</div>
@endmodule

{{--Cases Mgt--}}
<?php
$patientCaseMgt = getMenuLinks(\App\Models\User::MAIN_PATIENT_CASE)
?>
@if ($patientCaseMgt)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('patients*','patient-cases*','case-handlers*','patient-admissions*') ? 'active' : '' }}"
           href="{{ $patientCaseMgt }}">
            <span class="menu-icon"><i class="fas fa-user-injured"></i></span>
            <span class="menu-title">{{ __('messages.patients') }}</span>
            <span class="d-none">{{__('messages.cases')}}</span>
            <span class="d-none">{{__('messages.case_handlers')}}</span>
            <span class="d-none">{{__('messages.patient_admissions')}}</span>
        </a>
    </div>
@endif

{{--Pharmacsist--}}
@module('Pharmacists',$modules)
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('pharmacists*') ? 'active' : '' }}"
       href="{{ route('pharmacists.index') }}">
        <span class="menu-icon"><i class="fas fa-file-prescription"></i></span>
        <span class="menu-title">{{ __('messages.pharmacists') }}</span>
    </a>
</div>
@endmodule

{{-- Pathology --}}
@if(isFeatureAllowToUse('pathology.category.index'))
    <?php
    $pathologyMgt = getMenuLinks(\App\Models\User::MAIN_PATHOLOGY)
    ?>
    @if ($pathologyMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('pathology-categories*','pathology-tests*') ? 'active' : '' }}"
               href="{{ $pathologyMgt }}">
                <span class="menu-icon"><i class="fa fa-flask"></i></span>
                <span class="menu-title">{{ __('messages.pathologies') }}</span>
                <span class="d-none">{{__('messages.pathology_categories')}}</span>
                <span class="d-none">{{__('messages.pathology_tests')}}</span>
            </a>
        </div>
    @endif
@endif

{{--Receptinist--}}
@module('Receptionists',$modules)
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('receptionists*') ? 'active' : '' }}"
       href="{{ route('receptionists.index') }}">
        <span class="menu-icon"><i class="fa fa-user-tie"></i></span>
        <span class="menu-title">{{ __('messages.receptionists') }}</span>
    </a>
</div>
@endmodule

{{-- Hospital Activities dropdown --}}
@if(isFeatureAllowToUse('birth-reports.index'))
    <?php
    $reportMgt = getMenuLinks(\App\Models\User::MAIN_REPORT)
    ?>
    @if ($reportMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('birth-reports*','death-reports*','investigation-reports*','operation-reports*') ? 'active' : '' }}"
               href="{{ $reportMgt }}">
                <span class="menu-icon"><i class="fas fa-file-medical"></i></span>
                <span class="menu-title">{{ __('messages.reports') }}</span>
                <span class="d-none">{{__('messages.birth_reports')}}</span>
                <span class="d-none">{{__('messages.death_reports')}}</span>
                <span class="d-none">{{__('messages.investigation_reports')}}</span>
                <span class="d-none">{{__('messages.operation_reports')}}</span>
            </a>
        </div>
    @endif
@endif

{{-- Radiology --}}
@if(isFeatureAllowToUse('radiology.category.index'))
    <?php
    $radiology = getMenuLinks(\App\Models\User::MAIN_RADIOLOGY)
    ?>
    @if ($radiology)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('radiology-categories*','radiology-tests*') ? 'active' : '' }}"
               href="{{ $radiology }}">
                <span class="menu-icon"><i class="fa fa-x-ray"></i></span>
                <span class="menu-title">{{ __('messages.radiologies') }}</span>
                <span class="d-none">{{__('messages.radiology_categories')}}</span>
                <span class="d-none">{{__('messages.radiology_tests')}}</span>
            </a>
        </div>
    @endif
@endif

{{-- Services dropdown --}}
<?php
$serviceMgt = getMenuLinks(\App\Models\User::MAIN_SERVICE)
?>
@if ($serviceMgt)
    <div class="menu-item menu-accordion side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('insurances*','packages*','services*','ambulances*','ambulance-calls*') ? 'active' : '' }}"
           href="{{ $serviceMgt }}">
            <span class="menu-icon"><i class="fas fa-box"></i></span>
            <span class="menu-title">{{ __('messages.services') }}</span>
            <span class="d-none">{{__('messages.insurances')}}</span>
            <span class="d-none">{{__('messages.packages')}}</span>
            <span class="d-none">{{__('messages.services')}}</span>
            <span class="d-none">{{__('messages.ambulances')}}</span>
            <span class="d-none">{{__('messages.ambulance_calls')}}</span>
        </a>
    </div>
@endif

{{-- sms/mail--}}
@if(isFeatureAllowToUse('sms.index'))
    <?php
    $smsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
    ?>
    @if ($smsMailMgt)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('sms*','mail*') ? 'active' : '' }}"
               href="{{ $smsMailMgt }}"
               title="{{ __('SMS/Mail') }}">
        <span class="menu-icon">    
            <i class="fas fa-bell"></i>
		</span>
                <span class="menu-title">{{ __('SMS/Mail') }}</span>
                <span class="d-none">{{ __('messages.sms.sms') }}</span>
                <span class="d-none">{{ __('messages.mail') }}</span>
            </a>
        </div>
    @endif
@endif

{{-- Settings --}}
<div class="menu-item menu-accordion side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('settings*','hospital-schedule') ? 'active' : '' }}"
       href="{{ route('settings.edit') }}">
        <span class="menu-icon"><i class="fa fa-cogs"></i></span>
        <span class="menu-title">{{ __('messages.settings') }}</span>
        <span class="d-none">{{ __('messages.general') }}</span>
        <span class="d-none">{{ __('messages.sidebar_setting') }}</span>
    </a>
</div>


{{--Users--}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('users*') ? 'active' : '' }}"
       href="{{ route('users.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-friends"></i>
        </span>
        <span class="menu-title">{{ __('messages.users') }}</span>
    </a>
</div>

{{-- Subscriptions Transactions --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('my-transactions*') ? 'active' : '' }}"
       href="{{ route('subscriptions.plans.transactions.index') }}">
        <span class="menu-icon">
            <i class="fas fa-money-bill-wave"></i>
		</span>
        <span class="menu-title">{{ __('messages.subscription_plans.transactions') }}</span>
    </a>
</div>


{{-- Vaccination --}}
@if(isFeatureAllowToUse('vaccinated-patients.index'))
    <?php
    $vaccinationsPatient = getMenuLinks(\App\Models\User::MAIN_VACCINATION_MGT)
    ?>
    @if ($vaccinationsPatient)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('vaccinated-patients*','vaccinations*') ? 'active' : '' }}"
               href="{{ $vaccinationsPatient }}">
                <span class="menu-icon">
                     <i class="fas fa-syringe"></i>
                </span>
                <span class="menu-title">{{ __('messages.vaccinations') }}</span>
                <span class="d-none">{{__('messages.vaccinated_patients')}}</span>
            </a>
        </div>
    @endif
@endif
@endrole
@if(Auth::user()->email_verified_at != null)
    @role('Doctor')
    @module('Appointments',$modules)
    @if(isFeatureAllowToUse('appointments.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('appointments*') ? 'active' : '' }}"
               href="{{ route('appointments.index') }}">
                <span class="menu-icon"><i class="nav-icon fas fa-calendar-check"></i></span>
                <span class="menu-title">{{ __('messages.appointments') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{--Bed Management --}}
    <?php
    $bedDoctorMGT = getMenuLinks(\App\Models\User::MAIN_DOCTOR_BED_MGT)
    ?>
    @if ($bedDoctorMGT)
        {{--Bed Management --}}
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('bed-assigns*') ? 'active' : '' }}"
               href="{{ $bedDoctorMGT }}">
                <span class="menu-icon"><i class="fas fa-bed"></i></span>
                <span class="menu-title">{{ __('messages.bed_management') }}</span>
                <span class="d-none">{{__('messages.bed_assigns')}}</span>
            </a>
        </div>
    @endif

    @module('Doctors',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/doctor*','prescriptions*','schedules*','doctors*') ? 'active' : '' }}"
           href="{{ route('doctor') }}">
            <span class="menu-icon"><i class="fa fa-user-md"></i></span>
            <span class="menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </div>
    @endmodule

    @module('Documents',$modules)
    @if(isFeatureAllowToUse('documents.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('documents*') ? 'active' : '' }}"
               href="{{ route('documents.index') }}">
                <span class="menu-icon"><i class="fas fa-file"></i></span>
                <span class="menu-title">{{ __('messages.documents') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosisDoctorMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosisDoctorMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}"
               href="{{ $diagnosisDoctorMGT }}">
                <span class="menu-icon"><i class="fas fa-diagnoses"></i></span>
                <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </div>
    @endif

    {{-- Front settings --}}
    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>

    {{--ipds/opds--}}
    <?php
    $ipdOPD = getMenuLinks(\App\Models\User::MAIN_IPD_OPD)
    ?>
    @if ($ipdOPD)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('ipds*','opds*') ? 'active' : '' }}"
               href="{{ $ipdOPD }}"
               title="{{ __('messages.ipd_opd') }}">
        <span class="menu-icon">
            <i class="fas fa-notes-medical"></i>
		</span>
                <span class="menu-title">{{ __('messages.ipd_opd') }}</span>
                <span class="d-none">{{__('messages.ipd_patients')}}</span>
                <span class="d-none">{{__('messages.opd_patients')}}</span>
            </a>
        </div>
    @endif

    {{-- Live Consultation --}}
    @if(isFeatureAllowToUse('live.consultation.index'))
        <?php
        $liveConsultation = getMenuLinks(\App\Models\User::MAIN_LIVE_CONSULATION)
        ?>
        @if ($liveConsultation)
            <div class="menu-item menu-accordion side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('live-consultation*','live-meeting*') ? 'active' : '' }}"
                   href="{{ $liveConsultation }}">
                    <span class="menu-icon"><i class="fa fa-video"></i></span>
                    <span class="menu-title">{{ __('messages.live_consultations') }}</span>
                    <span class="d-none">{{ __('messages.live_meetings') }}</span>
                </a>
            </div>
        @endif
    @endif

    {{-- My Payrolls --}}
    @module('My Payrolls',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
           href="{{ route('payroll') }}">
            <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Patients --}}
    <?php
    $patientDoctorCaseMgt = getMenuLinks(\App\Models\User::MAIN_DOCTOR_PATIENT_CASE)
    ?>
    @if ($patientDoctorCaseMgt)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patient-admissions*') ? 'active' : '' }}"
               href="{{ $patientDoctorCaseMgt }}">
                <span class="menu-icon"><i class="fas fa-user-injured"></i></span>
                <span class="menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </div>
    @endif

    {{-- Reports --}}
    @if(isFeatureAllowToUse('birth-reports.index'))
        {{-- Reports --}}
        <?php
        $reportDoctorMgt = getMenuLinks(\App\Models\User::MAIN_REPORT)
        ?>
        @if ($reportDoctorMgt)
            <div class="menu-item menu-accordion side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('birth-reports*','death-reports*','investigation-reports*','operation-reports*') ? 'active' : '' }}"
                   href="{{ $reportDoctorMgt }}">
                    <span class="menu-icon"><i class="fas fa-file-medical"></i></span>
                    <span class="menu-title">{{ __('messages.reports') }}</span>
                    <span class="d-none">{{__('messages.birth_reports')}}</span>
                    <span class="d-none">{{__('messages.death_reports')}}</span>
                    <span class="d-none">{{__('messages.investigation_reports')}}</span>
                    <span class="d-none">{{__('messages.operation_reports')}}</span>
                </a>
            </div>
        @endif
    @endif

    {{-- SMS --}}
    @module('SMS',$modules)
    @if(isFeatureAllowToUse('sms.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('sms*') ? 'active' : '' }}"
               href="{{ route('sms.index') }}">
                <span class="menu-icon"><i class="fas fa fa-sms"></i></span>
                <span class="menu-title">{{ __('messages.sms.sms') }}</span>
            </a>
        </div>
    @endif
    @endmodule
    @endmodule
    @endrole

    @role('Case Manager')
    @module('Doctors',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/doctor*') ? 'active' : '' }}"
               href="{{ route('doctor') }}">
                <span class="menu-icon"><i class="fa fa-user-md"></i></span>
                <span class="menu-title">{{ __('messages.doctors') }}</span>
            </a>
        </div>
    @endmodule

    {{-- Notice Boards --}}
    @module('Notice Boards',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
               href="{{ url('employee/notice-board') }}">
                <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
                <span class="menu-title">{{ __('messages.notice_boards') }}</span>
                <span class="d-none">{{ __('messages.notice_boards') }}</span>
            </a>
        </div>

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('My Payrolls',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
           href="{{ route('payroll') }}">
            <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Patient admissions and Cases --}}
    <?php
    $patientCaseMangerCaseMgt = getMenuLinks(\App\Models\User::MAIN_CASE_MANGER_PATIENT_CASE)
    ?>
    @if ($patientCaseMangerCaseMgt)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patient-admissions*','patient-cases*') ? 'active' : '' }}"
               href="{{ $patientCaseMangerCaseMgt }}"
               title="{{ __('Patients') }}">
                <span class="menu-icon"><i class="fas fa-user-injured"></i></span>
                <span class="menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.case_handlers')}}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </div>
    @endif

    {{-- Ambulances and Ambulance Calls --}}
    <?php
    $serviceCaseMangerCaseMgt = getMenuLinks(\App\Models\User::MAIN_CASE_MANGER_SERVICE)
    ?>
    @if ($serviceCaseMangerCaseMgt)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('ambulances*','ambulance-calls*') ? 'active' : '' }}"
               href="{{ $serviceCaseMangerCaseMgt }}"
               title="{{ __('Services') }}">
                <span class="menu-icon"><i class="fas fa-box"></i></span>
                <span class="menu-title">{{ __('messages.services') }}</span>
                <span class="d-none">{{__('messages.ambulances')}}</span>
                <span class="d-none">{{__('messages.ambulance_calls')}}</span>
            </a>
        </div>
    @endif

    {{-- Mail and SMS --}}
    @if(isFeatureAllowToUse('sms.index'))
        <?php
        $smsMailCaseManagerMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
        ?>
        @if ($smsMailCaseManagerMgt)
            <div class="menu-item side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('sms*','mail*') ? 'active' : '' }}"
                   href="{{ route('sms.index') }}"
                   title="{{ __('SMS/Mail') }}">
        <span class="menu-icon">
            <i class="fas fa-bell"></i>
		</span>
                    <span class="menu-title">{{ __('SMS/Mail') }}</span>
                </a>
            </div>
        @endif
    @endif
    @endmodule
    @endrole

    @role('Receptionist')
    {{--Appointments--}}
    @module('Appointments',$modules)
    @if(isFeatureAllowToUse('appointments.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('appointments*') ? 'active' : '' }}"
               href="{{ route('appointments.index') }}">
                <span class="menu-icon"><i class="fas fa-calendar-check"></i></span>
                <span class="menu-title">{{ __('messages.appointments') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{--Doctors--}}
    @module('Doctors',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('doctors*') ? 'active' : '' }}"
           href="{{ route('doctors.index') }}">
            <span class="menu-icon"><i class="fa fa-user-md"></i></span>
            <span class="menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </div>
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosisReceptionistMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosisReceptionistMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}"
               href="{{ $diagnosisReceptionistMGT }}">
                <span class="menu-icon"><i class="fas fa-diagnoses"></i></span>
                <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </div>
    @endif

    {{--Enquires--}}
    @module('Enquires',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : '' }}"
           href="{{ route('enquiries') }}">
            <span class="menu-icon"><i class="fas fa-question-circle"></i></span>
            <span class="menu-title">{{ __('messages.enquiries') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Front office --}}
    <?php
    $frontReceptionistOfficeMGT = getMenuLinks(\App\Models\User::MAIN_FRONT_OFFICE)
    ?>
    @if ($frontReceptionistOfficeMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('call-logs*','visitor*','receives*','dispatches*') ? 'active' : '' }}"
               href="{{ $frontReceptionistOfficeMGT }}">
                <span class="menu-icon"><i class="fa fa-dungeon"></i></span>
                <span class="menu-title">{{ __('messages.front_office') }}</span>
                <span class="d-none">{{ __('messages.call_logs') }}</span>
                <span class="d-none">{{ __('messages.visitors') }}</span>
                <span class="d-none">{{ __('messages.postal_receive') }}</span>
                <span class="d-none">{{ __('messages.postal_dispatch') }}</span>
            </a>
        </div>  
    @endif

    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('notice-board*','testimonials*') ? 'active' : '' }}"
           href="{{ route('noticeboard') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.front_settings') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Hospital Charges --}}
    <?php
    $ReceptionisthospitalCharge = getMenuLinks(\App\Models\User::MAIN_HOSPITAL_CHARGE)
    ?>
    @if ($ReceptionisthospitalCharge)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('charge-categories*','charges*','doctor-opd-charges*') ? 'active' : '' }}"
               href="{{ $ReceptionisthospitalCharge }}">
                <span class="menu-icon"><i class="fas fa-coins"></i></span>
                <span class="menu-title">{{ __('messages.hospital_charges') }}</span>
                <span class="d-none">{{ __('messages.charge_categories') }}</span>
                <span class="d-none">{{ __('messages.charges') }}</span>
                <span class="d-none">{{ __('messages.doctor_opd_charges') }}</span>
            </a>
        </div>
    @endif

    {{--ipds/opds--}}
    <?php
    $receptionistIpdOPD = getMenuLinks(\App\Models\User::MAIN_IPD_OPD)
    ?>
    @if ($receptionistIpdOPD)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('ipds*','opds*') ? 'active' : '' }}"
               href="{{ $receptionistIpdOPD }}"
               title="{{ __('messages.ipd_opd') }}">
    <span class="menu-icon">
        <i class="fas fa-notes-medical"></i>
    </span>
                <span class="menu-title">{{ __('messages.ipd_opd') }}</span>
                <span class="d-none">{{__('messages.ipd_patients')}}</span>
                <span class="d-none">{{__('messages.opd_patients')}}</span>
            </a>
        </div>
    @endif

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
                <span class="d-none">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('My Payrolls',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
           href="{{ route('payroll') }}">
            <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule

    {{--Cases Mgt--}}
    <?php
    $receptionistPatientCaseMgt = getMenuLinks(\App\Models\User::MAIN_PATIENT_CASE)
    ?>
    @if ($receptionistPatientCaseMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patients*','patient-cases*','case-handlers*','patient-admissions*') ? 'active' : '' }}"
               href="{{ $receptionistPatientCaseMgt }}">
                <span class="menu-icon"><i class="fas fa-user-injured"></i></span>
                <span class="menu-title">{{ __('messages.patients') }}</span>
                <span class="d-none">{{__('messages.cases')}}</span>
                <span class="d-none">{{__('messages.case_handlers')}}</span>
                <span class="d-none">{{__('messages.patient_admissions')}}</span>
            </a>
        </div>
    @endif

    {{-- Pathology --}}
    @if(isFeatureAllowToUse('pathology.category.index'))
        <?php
        $receptionistPathologyMgt = getMenuLinks(\App\Models\User::MAIN_PATHOLOGY)
        ?>
        @if ($receptionistPathologyMgt)
            <div class="menu-item menu-accordion side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('pathology-categories*','pathology-tests*') ? 'active' : '' }}"
                   href="{{ $receptionistPathologyMgt }}">
                    <span class="menu-icon"><i class="fa fa-flask"></i></span>
                    <span class="menu-title">{{ __('messages.pathologies') }}</span>
                    <span class="d-none">{{__('messages.pathology_categories')}}</span>
                    <span class="d-none">{{__('messages.pathology_tests')}}</span>
                </a>
            </div>
        @endif
    @endif

    {{-- Radiology --}}
    @if(isFeatureAllowToUse('radiology.category.index'))
        <?php
        $receptionistRadiology = getMenuLinks(\App\Models\User::MAIN_RADIOLOGY)
        ?>
        @if ($receptionistRadiology)
            <div class="menu-item menu-accordion side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('radiology-categories*','radiology-tests*') ? 'active' : '' }}"
                   href="{{ $receptionistRadiology }}">
                    <span class="menu-icon"><i class="fa fa-x-ray"></i></span>
                    <span class="menu-title">{{ __('messages.radiologies') }}</span>
                    <span class="d-none">{{__('messages.radiology_categories')}}</span>
                    <span class="d-none">{{__('messages.radiology_tests')}}</span>
                </a>
            </div>
        @endif
    @endif

    {{-- Services dropdown --}}
    <?php
    $receptionistServiceMgt = getMenuLinks(\App\Models\User::MAIN_SERVICE)
    ?>
    @if ($receptionistServiceMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('insurances*','packages*','services*','ambulances*','ambulance-calls*') ? 'active' : '' }}"
               href="{{ $receptionistServiceMgt }}">
                <span class="menu-icon"><i class="fas fa-box"></i></span>
                <span class="menu-title">{{ __('messages.services') }}</span>
                <span class="d-none">{{__('messages.insurances')}}</span>
                <span class="d-none">{{__('messages.packages')}}</span>
                <span class="d-none">{{__('messages.services')}}</span>
                <span class="d-none">{{__('messages.ambulances')}}</span>
                <span class="d-none">{{__('messages.ambulance_calls')}}</span>
            </a>
        </div>
    @endif

    {{-- Mail and SMS --}}
    @if(isFeatureAllowToUse('sms.index'))
        <?php
        $receptionistSmsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
        ?>
        @if ($receptionistSmsMailMgt)
            <div class="menu-item side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('sms*','mail*') ? 'active' : '' }}"
                   href="{{ $receptionistSmsMailMgt }}"
                   title="{{ __('SMS/Mail') }}">
        <span class="menu-icon">
            <i class="fas fa-bell"></i>
		</span>
                    <span class="menu-title">{{ __('SMS/Mail') }}</span>
                    <span class="d-none">{{ __('messages.sms.sms') }}</span>
                    <span class="d-none">{{ __('messages.mail') }}</span>
                </a>
            </div>
        @endif
    @endif

    {{--@module('Testimonial',$modules)--}}
    {{--<div class="menu-item side-menus">--}}
    {{--    <a class="menu-link menu-text-wrap {{ Request::is('testimonials*') ? 'active' : '' }}"--}}
    {{--       href="{{ route('testimonials.index') }}">--}}
    {{--        <span class="menu-icon"><i class="fas fa fa-cog"></i></span>--}}
    {{--        <span class="menu-title">{{ __('messages.front_settings') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>--}}
    {{--    </a>--}}
    {{--</div>--}}
    {{--@endmodule--}}
    @endrole

    @role('Pharmacist')
    @module('Doctors',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/doctor*') ? 'active' : '' }}"
               href="{{ route('doctor') }}">
                <span class="menu-icon"><i class="fa fa-user-md"></i></span>
                <span class="menu-title">{{ __('messages.doctors') }}</span>
            </a>
        </div>
    @endmodule

    @module('Prescriptions',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/prescriptions*') ? 'active' : '' }}"
           href="{{ url('employee/prescriptions') }}">
            <span class="menu-icon"><i class="fas fa-prescription"></i></span>
            <span class="menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </div>
    @endmodule
    
    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{-- Medicines--}}
    <?php
    $medicinePharmacistMgt = getMenuLinks(\App\Models\User::MAIN_MEDICINES)
    ?>
    @if ($medicinePharmacistMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('categories*','brands*','medicines*') ? 'active' : '' }}"
               href="{{ $medicinePharmacistMgt }}">
                <span class="menu-icon"><i class="fas fa-capsules"></i></span>
                <span class="menu-title">{{ __('messages.medicines') }}</span>
                <span class="d-none">{{__('messages.medicine_categories')}}</span>
                <span class="d-none">{{__('messages.medicine_brands')}}</span>
                <span class="d-none">{{__('messages.medicines')}}</span>
            </a>
        </div>
    @endif

    @module('My Payrolls',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
           href="{{ route('payroll') }}">
            <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule

    @module('Pathology Tests',$modules)
    @if(isFeatureAllowToUse('pathology.test.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('pathology-tests*') ? 'active' : '' }}"
               href="{{ route('pathology.test.index') }}">
                <span class="menu-icon"><i class="fa fa-flask"></i></span>
                <span class="menu-title">{{ __('messages.pathologies') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('Radiology Tests',$modules)
    @if(isFeatureAllowToUse('radiology.test.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('radiology-tests*') ? 'active' : '' }}"
               href="{{ route('radiology.test.index') }}">
                <span class="menu-icon"><i class="fa fa-x-ray"></i></span>
                <span class="menu-title">{{ __('messages.radiologies') }}</span>
                <span class="d-none">{{__('messages.radiology_tests')}}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{-- SMS --}}
    @module('SMS',$modules)
    @if(isFeatureAllowToUse('sms.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('sms*') ? 'active' : '' }}"
               href="{{ route('sms.index') }}">
                <span class="menu-icon"><i class="fas fa fa-sms"></i></span>
                <span class="menu-title">{{ __('messages.sms.sms') }}</span>
            </a>
        </div>
    @endif
    @endmodule
    @endrole

    @role('Nurse')
    {{-- Bed Manager --}}
    <?php $bedNurseMGT = getMenuLinks(\App\Models\User::MAIN_BED_MGT)
    ?>
    @if ($bedNurseMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('bed-types*','beds*','bed-assigns*','bulk-beds') ? 'active' : '' }}"
               href="{{ $bedNurseMGT }}">
                <span class="menu-icon"><i class="nav-icon fas fa-bed"></i></span>
                <span class="menu-title">{{ __('messages.bed_management') }}</span>
                <span class="d-none">{{__('messages.bed_types')}}</span>
                <span class="d-none">{{__('messages.beds')}}</span>
                <span class="d-none">{{__('messages.bed_assigns')}}</span>
            </a>
        </div>
    @endif

    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{--My Payrolls--}}
    @module('My Payrolls',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
               href="{{ route('payroll') }}">
                <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
            </a>
        </div>
    @endmodule

    @endrole

    @role('Lab Technician')
    {{-- Blood Bank dropdown --}}
    @if(isFeatureAllowToUse('blood-banks.index'))
        <?php
        $bloodbankLabMGT = getMenuLinks(\App\Models\User::MAIN_BLOOD_BANK_MGT)
        ?>
        @if ($bloodbankLabMGT)
            <div class="menu-item menu-accordion side-menus">
                <a class="menu-link menu-text-wrap {{ Request::is('blood-banks*','blood-donors*','blood-donations*','blood-issues*') ? 'active' : '' }}"
                   href="{{ $bloodbankLabMGT }}">
                    <span class="menu-icon"><i class="fas fa-tint"></i></span>
                    <span class="menu-title">{{ __('messages.blood_bank') }}</span>
                    <span class="d-none">{{__('messages.blood_donors')}}</span>
                    <span class="d-none">{{__('messages.blood_donations')}}</span>
                    <span class="d-none">{{__('messages.blood_issues')}}</span>
                </a>
            </div>
        @endif
    @endif

    @module('Doctors',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/doctor*') ? 'active' : '' }}"
           href="{{ route('doctor') }}">
            <span class="menu-icon"><i class="fa fa-user-md"></i></span>
            <span class="menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </div>
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosiLabMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosiLabMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}"
               href="{{ $diagnosiLabMGT }}">
                <span class="menu-icon"><i class="fas fa-diagnoses"></i></span>
                <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </div>
    @endif

    {{-- Front Settings--}}
    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{-- Medicines--}}
    <?php
    $medicinelabMgt = getMenuLinks(\App\Models\User::MAIN_MEDICINES)
    ?>
    @if ($medicinelabMgt)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('categories*','brands*','medicines*') ? 'active' : '' }}"
               href="{{ $medicinelabMgt }}">
                <span class="menu-icon"><i class="fas fa-capsules"></i></span>
                <span class="menu-title">{{ __('messages.medicines') }}</span>
                <span class="d-none">{{__('messages.medicine_categories')}}</span>
                <span class="d-none">{{__('messages.medicine_brands')}}</span>
                <span class="d-none">{{__('messages.medicines')}}</span>
            </a>
        </div>
    @endif

    {{-- My Payrolls--}}
    @module('My Payrolls',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
           href="{{ route('payroll') }}">
            <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule

    {{--Pathologies--}}
    @module('Pathology Tests',$modules)
    @if(isFeatureAllowToUse('pathology.test.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('pathology-tests*') ? 'active' : '' }}"
               href="{{ route('pathology.test.index') }}">
                <span class="menu-icon"><i class="fa fa-flask"></i></span>
                <span class="menu-title">{{ __('messages.pathologies') }}</span>
                <span class="d-none">{{__('messages.pathology_tests')}}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('Radiology Tests',$modules)
    @if(isFeatureAllowToUse('radiology.test.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('radiology-tests*') ? 'active' : '' }}"
               href="{{ route('radiology.test.index') }}">
                <span class="menu-icon"><i class="fa fa-x-ray"></i></span>
                <span class="menu-title">{{ __('messages.radiologies') }}</span>
                <span class="d-none">{{__('messages.radiology_tests')}}</span>
            </a>
        </div>
    @endif
    @endmodule
    @endrole

    @role('Accountant')
    {{-- Account Manager dropdown --}}
    <?php
    $billingAccountMGT = getMenuLinks(\App\Models\User::MAIN_ACCOUNT_MANAGER_MGT)
    ?>
    @if ($billingAccountMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('accounts*','employee-payrolls*','invoices*','payments*','bills*') ? 'active' : '' }}"
               href="{{ $billingAccountMGT }}">
                <span class="menu-icon"><i class="fab fa-adn"></i></span>
                <span class="menu-title">{{ __('messages.account_manager') }}</span>
                <span class="d-none">{{ __('messages.accounts') }}</span>
                <span class="d-none">{{__('messages.employee_payrolls')}}</span>
                <span class="d-none">{{__('messages.invoices')}}</span>
                <span class="d-none">{{__('messages.payments')}}</span>
                <span class="d-none">{{__('messages.bills')}}</span>
            </a>
        </div>
    @endif

    {{-- Finance --}}
    <?php
    $financeAccountantMGT = getMenuLinks(\App\Models\User::MAIN_FINANCE)
    ?>
    @if ($financeAccountantMGT)
        <div class="menu-item menu-accordion side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('incomes*','expenses*') ? 'active' : '' }}"
               href="{{ $financeAccountantMGT }}">
                <span class="menu-icon"><i class="fas fa-money-bill"></i></span>
                <span class="menu-title">{{__('messages.finance')}}</span>
                <span class="d-none">{{ __('messages.incomes.incomes') }}</span>
                <span class="d-none">{{ __('messages.expenses') }}</span>
            </a>
        </div>
    @endif

    {{-- Notice Boards--}}
    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{-- Live Meeting --}}
    @module('Live Meetings',$modules)
    @if(isFeatureAllowToUse('live.meeting.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-meeting*') ? 'active' : '' }}"
               href="{{ route('live.meeting.index') }}">
                <span class="menu-icon"><i class="fa fa-file-video"></i></span>
                <span class="menu-title">{{ __('messages.live_meetings') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    {{--My Payrolls --}}
    @module('My Payrolls',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/payroll') ? 'active' : '' }}"
               href="{{ route('payroll') }}">
                <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
                <span>{{ __('messages.my_payrolls') }}</span>
            </a>
        </div>
    @endmodule

    {{-- Services --}}
    @module('Services',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('services*') ? 'active' : '' }}"
               href="{{ route('services.index') }}">
                <span class="menu-icon"><i class="fas fa-box"></i></span>
                <span class="menu-title">{{ __('messages.services') }}</span>
            </a>
        </div>
    @endmodule

    {{-- SMS --}}
    @module('SMS',$modules)
    @if(isFeatureAllowToUse('sms.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('sms*') ? 'active' : '' }}"
               href="{{ route('sms.index') }}">
                <span class="menu-icon"><i class="fas fa fa-sms"></i></span>
                <span class="menu-title">{{ __('messages.sms.sms') }}</span>
            </a>
        </div>
    @endif
    @endmodule
    @endrole

    @role('Patient')

    @module('Appointments',$modules)
    @if(isFeatureAllowToUse('appointments.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('appointments*') ? 'active' : '' }}"
               href="{{ route('appointments.index') }}">
                <span class="menu-icon"><i class="fas fa-calendar-check"></i></span>
                <span class="menu-title">{{ __('messages.appointments') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('Bills',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/bills*') ? 'active' : '' }}"
           href="{{ url('employee/bills') }}">
            <span class="menu-icon"><i class="fa fa-rupee-sign"></i></span>
            <span class="menu-title">{{ __('messages.bills') }}</span>
        </a>
    </div>
    @endmodule

    {{--Diagnosis test Report--}}
    @module('Diagnosis Tests',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/patient-diagnosis-test*') ? 'active' : '' }}"
               href="{{ route('patient-diagnosis-test') }}">
                <span class="menu-icon"><i class="fas fa-file-medical"></i></span>
                <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </div>
    @endmodule

    {{-- Documents--}}
    @module('Documents',$modules)
    @if(isFeatureAllowToUse('documents.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('documents*') ? 'active' : '' }}"
               href="{{ route('documents.index') }}">
                <span class="menu-icon"><i class="fas fa-file"></i></span>
                <span class="menu-title">{{ __('messages.documents') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('Notice Boards',$modules)
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-icon"><i class="fas fa fa-cog"></i></span>
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule

    {{--ipds/opds--}}
    <div class="menu-item side-menus">
        <a class="menu-link menu-text-wrap {{ Request::is('patient/my-ipds*','opds*','patient/my-opds*') ? 'active' : '' }}"
               href="{{ route('patient.ipd') }}"
               title="{{ __('messages.ipd_opd') }}">
        <span class="menu-icon">
            <i class="fas fa-notes-medical"></i>
        </span>
                <span class="menu-title">{{ __('messages.ipd_opd') }}</span>
                <span class="d-none">{{__('messages.ipd_patients')}}</span>
                <span class="d-none">{{__('messages.opd_patients')}}</span>
            </a>
        </div>

    @module('Invoices',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/invoices*') ? 'active' : '' }}"
               href="{{ route('invoices') }}">
                <span class="menu-icon"><i class="fas fa-file-invoice"></i></span>
                <span class="menu-title">{{ __('messages.invoices') }}</span>
            </a>
        </div>
    @endmodule

    {{-- Live Consultation --}}
    @module('Live Consultations',$modules)
    @if(isFeatureAllowToUse('live.consultation.index'))
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('live-consultation*') ? 'active' : '' }}"
               href="{{ route('live.consultation.index') }}">
                <span class="menu-icon"><i class="fa fa-video"></i></span>
                <span class="menu-title">{{ __('messages.live_consultations') }}</span>
            </a>
        </div>
    @endif
    @endmodule

    @module('Patient Cases',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patient/my-cases*') ? 'active' : '' }}"
               href="{{ route('patients.cases') }}">
                <span class="menu-icon"><i class="fa fa-briefcase-medical"></i></span>
                <span class="menu-title">{{ __('messages.patients_cases') }}</span>
            </a>
        </div>
    @endmodule

    @module('Patient Admissions',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('employee/patient-admissions*') ? 'active' : '' }}"
               href="{{ route('patient-admissions') }}">
                <span class="menu-icon"><i class="fas fa-history"></i></span>
                <span class="menu-title">{{ __('messages.patient_admissions') }}</span>
            </a>
        </div>
    @endmodule

    @module('Prescriptions',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patient/my-prescriptions*') ? 'active' : '' }}"
               href="{{ route('prescriptions.list') }}">
                <span class="menu-icon"><i class="fas fa-prescription"></i></span>
                <span class="menu-title">{{ __('messages.prescriptions') }}</span>
            </a>
        </div>
    @endmodule

    @module('Vaccinated Patients',$modules)
        <div class="menu-item side-menus">
            <a class="menu-link menu-text-wrap {{ Request::is('patient/my-vaccinated*') ? 'active' : '' }}"
               href="{{ route('patient.vaccinated') }}">
                <span class="menu-icon"><i class="fas fa-head-side-mask"></i></span>
                <span class="menu-title">{{ __('messages.vaccinated_patients') }}</span>
            </a>
        </div>
    @endmodule
    @endrole
@endif

{{-- Super Admin menu links --}}
@role('Super Admin')
{{-- Super Admin Dashboard --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/dashboard*') ? 'active' : '' }}"
       href="{{ route('super.admin.dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa-chart-pie"></i>
		</span>
        <span class="menu-title">{{ __('messages.dashboard.dashboard') }}</span>
    </a>
</div>

{{-- Super Admin Users --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/hospitals*','super-admin/hospital*') ? 'active' : '' }}"
       href="{{ route('super.admin.hospitals.index') }}">
        <span class="menu-icon">
            <i class="fas fa-user-friends"></i>
		</span>
        <span class="menu-title">{{ __('messages.hospitals') }}</span>
    </a>
</div>

{{-- Super Admin Subscription Plan --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/subscription-plans*','super-admin/transactions*','super-admin/subscriptions-hospitals*') ? 'active' : '' }}"
       href="{{ route('super.admin.subscription.plans.index') }}">
        <span class="menu-icon">
            <i class="fas fa-rupee-sign"></i>
		</span>
        <span class="menu-title">{{ __('messages.billing') }}</span>
    </a>
</div>

{{-- Subscribers --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/subscribers*') ? 'active' : '' }}"
       href="{{ route('super.admin.subscribe.index') }}">
        <span class="menu-icon">
            <i class="fab fa-stripe-s"></i>
		</span>
        <span class="menu-title">{{ __('messages.subscribe.subscribers') }}</span>
    </a>
</div>

{{-- Enquiry --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/enquiries*') ? 'active' : '' }}"
       href="{{ route('super.admin.enquiry.index') }}">
        <span class="menu-icon">
            <i class="fab fa-elementor"></i>
		</span>
        <span class="menu-title">{{ __('messages.enquiries') }}</span>
    </a>
</div>

{{-- Landing Screen Section One --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/section-one*','super-admin/section-two*','super-admin/section-three*','super-admin/section-four*','super-admin/service-slider*','super-admin/admin-testimonial*','super-admin/faqs*','super-admin/section-five*','super-admin/about-us*') ? 'active' : '' }}"
       href="{{ route('super.admin.section.one') }}">
        <span class="menu-icon">
            <i class="fas fa fa-cog"></i>
		</span>
        <span class="menu-title">{{ __('messages.landing_cms.landing_cms') }}</span>
    </a>
</div>

{{-- Settings --}}
<div class="menu-item menu-accordion side-menus">
    <a class="menu-link menu-text-wrap {{ Request::is('super-admin/general-settings*','super-admin/footer-settings*') ? 'active' : '' }}"
       href="{{ route('super.admin.settings.edit') }}">
        <span class="menu-icon"><i class="fa fa-cogs"></i></span>
        <span class="menu-title">{{ __('messages.settings') }}</span>
        <span class="d-none">{{ __('messages.general') }}</span>
        <span class="d-none">{{ __('messages.sidebar_setting') }}</span>
    </a>
</div>
@endrole
