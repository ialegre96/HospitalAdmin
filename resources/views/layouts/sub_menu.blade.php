@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('dashboard*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    <div class="menu-item me-lg-1 {{ Request::is('dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard.dashboard') }}</span>
        </a>
    </div>
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('users*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    <div class="menu-item me-lg-1 {{ Request::is('users*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('users.index') }}">
            <span class="menu-title">{{ __('messages.users') }}</span>
        </a>
    </div>
    @endrole
</div>

{{-- Subscription Transaction Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('my-transactions*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('my-transactions*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('subscriptions.plans.transactions.index') }}">
            <span class="menu-title">{{ __('messages.subscription_plans.transactions') }}</span>
        </a>
    </div>
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('subscription-plans*') && !Request::is('choose-payment-type*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    <div class="menu-item me-lg-1 {{ Request::is('subscription-plans*') || Request::is('choose-payment-type*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('subscription.pricing.plans.index') }}">
            <span class="menu-title">{{ __('messages.subscription_plans.subscription_plans') }}</span>
        </a>
    </div>
    @endrole
</div>

<div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('ipds*','opds*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor|Receptionist')
    @module('IPD Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('ipds*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('ipd.patient.index') }}">
            <span class="menu-title">{{ __('messages.ipd_patients') }}</span>
        </a>
    </div>
    @endmodule
    @module('OPD Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('opds*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('opd.patient.index') }}">
            <span class="menu-title">{{ __('messages.opd_patients') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('vaccinated-patients*','vaccinations*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Vaccinated Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('vaccinated-patients*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('vaccinated-patients.index') }}">
            <span class="menu-title">{{ __('messages.vaccinated_patients') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Vaccinations',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('vaccinations*') ? 'show' : '' }}">
        <a class="menu-link py-3 "
           href="{{ route('vaccinations.index') }}">
            <span class="menu-title">{{ __('messages.vaccinations') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('accounts*','employee-payrolls*','invoices*','payments*','payment-reports*','advanced-payments*','bills*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Accountant')
    @module('Accounts',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('accounts*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('accounts.index') }}">
            <span class="menu-title">{{ __('messages.accounts') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Accountant')
    @module('Employee Payrolls',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee-payrolls*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('employee-payrolls.index') }}">
            <span class="menu-title">{{ __('messages.employee_payrolls') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Accountant')
    @module('Invoices',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('invoices*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('invoices.index') }}">
            <span class="menu-title">{{ __('messages.invoices') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Accountant')
    @module('Payments',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('payments*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('payments.index') }}">
            <span class="menu-title">{{ __('messages.payments') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Payment Reports',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('payment-reports*') ? 'show' : '' }}">
        <a class="menu-link py-3" href="{{ route('payment.reports') }}">
            <span class="menu-title">{{ __('messages.payment.payment_reports') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Advance Payments',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('advanced-payments*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('advanced-payments.index') }}">
            <span class="menu-title">{{ __('messages.advanced_payments') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Accountant')
    @module('Bills',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('bills*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('bills.index') }}">
            <span class="menu-title">{{ __('messages.bills') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('bed-types*','beds*','bed-assigns*','bulk-beds','bed-status')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Nurse')
    @module('Bed Types',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('bed-types*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('bed-types.index') }}">
            <span class="menu-title">{{ __('messages.bed_types') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Nurse')
    @module('Beds',$modules)
    <div class="menu-item me-lg-1 {{ (Request::is('beds*') || Request::is('bulk-beds')) ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('beds.index') }}">
            <span class="menu-title">{{ __('messages.beds') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Nurse|Doctor')
    @module('Bed Assigns',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('bed-assigns*','bed-status') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('bed-assigns.index') }}">
            <span class="menu-title">{{ __('messages.bed_assigns') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('blood-banks*','blood-donors*','blood-donations*','blood-issues*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Lab Technician')
    @module('Blood Banks',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('blood-banks*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('blood-banks.index') }}">
            <span class="menu-title">{{ __('messages.blood_banks') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Lab Technician')
    @module('Blood Donors',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('blood-donors*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('blood-donors.index') }}">
            <span class="menu-title">{{ __('messages.blood_donors') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Lab Technician')
    @module('Blood Donations',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('blood-donations*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('blood-donations.index') }}">
            <span class="menu-title">{{ __('messages.blood_donations') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Lab Technician')
    @module('Blood Issues',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('blood-issues*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('blood-issues.index') }}">
            <span class="menu-title">{{ __('messages.blood_issues') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('patients*','patient-cases*','case-handlers*','patient-admissions*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patients*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patients.index') }}">
            <span class="menu-title">{{ __('messages.patients') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Case Manager')
    @module('Cases',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient-cases*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient-cases.index') }}">
            <span class="menu-title">{{ __('messages.cases') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Case Handlers',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('case-handlers*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('case-handlers.index') }}">
            <span class="menu-title">{{ __('messages.case_handlers') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Doctor|Case Manager')
    @module('Patient Admissions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient-admissions*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient-admissions.index') }}">
            <span class="menu-title">{{ __('messages.patient_admissions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/doctor*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Case Manager|Pharmacist|Lab Technician')
    @module('Doctors',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/doctor*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ url('employee/doctor') }}">
            <span class="menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/prescriptions*')) ? 'd-none' : '' }}"
        id="#kt_header_menu" data-kt-menu="true">
    @role('Pharmacist')
    @module('Prescriptions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/prescriptions*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ url('employee/prescriptions') }}">
            <span class="menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('documents*','document-types*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor|Patient')
    @module('Documents',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('documents*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('documents.index') }}">
            <span class="menu-title">{{ __('messages.documents') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Document Types',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('document-types*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('document-types.index') }}">
            <span class="menu-title">{{ __('messages.document_types') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('insurances*','packages*','services*','ambulances*','ambulance-calls*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Insurances',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('insurances*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('insurances.index') }}">
            <span class="menu-title">{{ __('messages.insurances') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Packages',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('packages*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('packages.index') }}">
            <span class="menu-title">{{ __('messages.packages') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Accountant')
    @module('Services',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('services*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('services.index') }}">
            <span class="menu-title">{{ __('messages.services') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Case Manager')
    @module('Ambulances',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('ambulances*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('ambulances.index') }}">
            <span class="menu-title">{{ __('messages.ambulances') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Case Manager')
    @module('Ambulances Calls',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('ambulance-calls*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('ambulance-calls.index') }}">
            <span class="menu-title">{{ __('messages.ambulance_calls') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('doctors*','doctor-departments*','schedules*','prescriptions*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Doctors',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('doctors*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('doctors.index') }}">
            <span class="menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Doctor Departments',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('doctor-departments*') ? 'show' : '' }}">
        <?php
        $style = 'style=';
        $background = 'white-space:';
        ?>
        <a class="menu-link py-3"
           href="{{ route('doctor-departments.index') }}">
            <span class="menu-title" {{$style}}"{{$background}}nowrap">{{ __('messages.doctor_departments') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Schedules',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('schedules*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('schedules.index') }}">
            <span class="menu-title">{{ __('messages.schedules') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Prescriptions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('prescriptions*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('prescriptions.index') }}">
            <span class="menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('accountants*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Accountants',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('accountants*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('accountants.index') }}">
            <span class="menu-title">{{ __('messages.accountants') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('nurses*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Nurses',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('nurses*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('nurses.index') }}">
            <span class="menu-title">{{ __('messages.nurses') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('receptionists*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Receptionists',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('receptionists*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('receptionists.index') }}">
            <span class="menu-title">{{ __('messages.receptionists') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('lab-technicians*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Lab Technicians',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('lab-technicians*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('lab-technicians.index') }}">
            <span class="menu-title">{{ __('messages.lab_technicians') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('pharmacists*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Pharmacists',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('pharmacists*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('pharmacists.index') }}">
            <span class="menu-title">{{ __('messages.pharmacists') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('appointments*','appointment-calendars')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @module('Appointments',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('appointments*','appointment-calendars') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('appointments.index') }}">
            <span class="menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </div>
    @endmodule
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('birth-reports*','death-reports*','investigation-reports*','operation-reports*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor')
    @module('Birth Reports',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('birth-reports*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('birth-reports.index') }}">
            <span class="menu-title">{{ __('messages.birth_reports') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Doctor')
    @module('Death Reports',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('death-reports*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('death-reports.index') }}">
            <span class="menu-title">{{ __('messages.death_reports') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Doctor')
    @module('Investigation Reports',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('investigation-reports*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('investigation-reports.index') }}">
            <span class="menu-title">{{ __('messages.investigation_reports') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Doctor')
    @module('Operation Reports',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('operation-reports*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('operation-reports.index') }}">
            <span class="menu-title">{{ __('messages.operation_reports') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('categories*','brands*','medicines*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Pharmacist|Lab Technician')
    @module('Medicine Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('categories.index') }}">
            <span class="menu-title">{{ __('messages.medicine_categories') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Pharmacist|Lab Technician')
    @module('Medicine Brands',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('brands*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('brands.index') }}">
            <span class="menu-title">{{ __('messages.medicine_brands') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Pharmacist|Lab Technician')
    @module('Medicines',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('medicines*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('medicines.index') }}">
            <span class="menu-title">{{ __('messages.medicines') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('radiology-categories*','radiology-tests*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Radiology Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('radiology-categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('radiology.category.index') }}">
            <span class="menu-title">{{ __('messages.radiology_category.radiology_categories') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Pharmacist|Lab Technician')
    @module('Radiology Tests',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('radiology-tests*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('radiology.test.index') }}">
            <span class="menu-title">{{ __('messages.radiology_tests') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('pathology-categories*','pathology-tests*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Pathology Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('pathology-categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('pathology.category.index') }}">
            <span class="menu-title">{{ __('messages.pathology_category.pathology_categories') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist|Pharmacist|Lab Technician')
    @module('Pathology Tests',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('pathology-tests*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('pathology.test.index') }}">
            <span class="menu-title">{{ __('messages.pathology_tests') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('diagnosis-categories*','patient-diagnosis-test*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor|Receptionist|Lab Technician')
    @module('Diagnosis Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('diagnosis-categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('diagnosis.category.index') }}">
            <span class="menu-title">{{__('messages.diagnosis_category.diagnosis_categories')}}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Doctor|Receptionist|Lab Technician')
    @module('Diagnosis Tests',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient-diagnosis-test*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient.diagnosis.test.index') }}">
            <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('sms*','mail*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor|Accountant|Case Manager|Receptionist|Pharmacist')
    @module('SMS',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('sms*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('sms.index') }}">
            <span class="menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Case Manager|Receptionist')
    @module('Mail',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('mail*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('mail') }}">
            <span class="menu-title">{{ __('messages.mail') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>

<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('incomes*','expenses*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Accountant')
    @module('Income',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('incomes*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('incomes.index') }}">
            <span class="menu-title">{{__('messages.incomes.incomes')}}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Accountant')
    @module('Expense',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('expenses*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('expenses.index') }}">
            <span class="menu-title">{{__('messages.expenses')}}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('item-categories*','items*','item-stocks*','issued-items*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    @module('Items Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('item-categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('item-categories.index') }}">
            <span class="menu-title">{{ __('messages.items_categories') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Items',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('items*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('items.index') }}">
            <span class="menu-title">{{ __('messages.items') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Item Stocks',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('item-stocks*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('item.stock.index') }}">
            <span class="menu-title">{{ __('messages.items_stocks') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin')
    @module('Issued Items',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('issued-items*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('issued.item.index') }}">
            <span class="menu-title">{{ __('messages.issued_items') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('charge-categories*','charges*','doctor-opd-charges*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Charge Categories',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('charge-categories*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('charge-categories.index') }}">
            <span class="menu-title">{{ __('messages.charge_categories') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Charges',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('charges*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('charges.index') }}">
            <span class="menu-title">{{ __('messages.charges') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Doctor OPD Charges',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('doctor-opd-charges*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('doctor-opd-charges.index') }}">
            <span class="menu-title">{{__('messages.doctor_opd_charges')}}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('call-logs*','visitor*','receives*','dispatches*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Call Logs',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('call-logs*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('call_logs.index') }}">
            <span class="menu-title">{{ __('messages.call_logs') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Visitors',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('visitor*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('visitors.index') }}">
            <span class="menu-title">{{ __('messages.visitors') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Postal Receive',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('receives*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('receives.index') }}">
            <span class="menu-title">{{ __('messages.postal_receive') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Postal Dispatch',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('dispatches*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('dispatches.index') }}">
            <span class="menu-title">{{ __('messages.postal_dispatch') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('live-consultation*','live-meeting*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Doctor|Patient')
    @module('Live Consultations',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('live-consultation*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('live.consultation.index') }}">
            <span class="menu-title">{{ __('messages.live_consultations') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Doctor|Accountant|Case Manager|Receptionist|Pharmacist|Lab Technician|Nurse')
    @module('Live Meetings',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('live-meeting*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('live.meeting.index') }}">
            <span class="menu-title">{{ __('messages.live_meetings') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
@php($sectionName = (Request::get('section') === null && !Request::is('hospital-schedules')) ? 'general' : Request::get('section'))
<div
        class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (Request::is('settings*','hospital-schedules')) ? '' : 'd-none' }}"
        id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ (isset($sectionName) && $sectionName == 'general') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('settings.edit', ['section' => 'general']) }}">
            <span class="menu-title">{{ __('messages.general') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('hospital-schedules*') ? 'show' : ''  }}">
        <a class="menu-link py-3"
           href="{{ route('hospital-schedules.index') }}">
            <span class="menu-title">{{ __('messages.hospital_schedules') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ (isset($sectionName) && $sectionName == 'sidebar_setting') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('settings.edit', ['section' => 'sidebar_setting']) }}">
            <span class="menu-title">{{ __('messages.sidebar_setting') }}</span>
        </a>
    </div>
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*','terms-and-conditions*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin')
    <div class="menu-item me-lg-1 {{ Request::is('front-settings*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('front.settings.index') }}">
            <span class="menu-title">{{ __('messages.cms') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('front-cms-services*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('front.cms.services.index') }}">
            <span class="menu-title">{{ __('messages.front_cms_services') }}</span>
        </a>
    </div>
    @endrole
    @role('Admin|Receptionist')
    @module('Notice Boards',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('notice-boards*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('notice-boards') }}">
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
    @role('Admin|Receptionist')
    @module('Testimonial',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('testimonials*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('testimonials.index') }}">
            <span class="menu-title">{{ __('messages.testimonials') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>

<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('enquiries*','enquiry*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Admin|Receptionist')
    @module('Enquires',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ route('enquiries') }}">
            <span class="menu-title">{{ __('messages.enquiries') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/doctor*','prescriptions*','schedules*','doctors*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Doctor')
    @module('Doctors',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/doctor*','doctors*') ? 'show' : ''  }}">
        <a class="menu-link py-3" href="{{ url('employee/doctor') }}">
            <span class="menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </div>
    @endmodule
    @module('Schedules',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('schedules*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('schedules.index') }}">
            <span class="menu-title">{{ __('messages.schedules') }}</span>
        </a>
    </div>
    @endmodule
    @module('Prescriptions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('prescriptions*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('prescriptions.index') }}">
            <span class="menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/notice-board*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Doctor|Accountant|Case Manager|Receptionist|Pharmacist|Lab Technician|Nurse|Patient')
    @module('Notice Boards',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/notice-board*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="menu-title">{{ __('messages.notice_boards') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/payroll*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Doctor|Accountant|Case Manager|Receptionist|Pharmacist|Lab Technician|Nurse')
    @module('My Payrolls',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/payroll*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('payroll') }}">
            <span class="menu-title">{{ __('messages.my_payrolls') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('patient/my-cases*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Patient Cases',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient/my-cases*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('patient/my-cases') }}">
            <span class="menu-title">{{ __('messages.patients_cases') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/patient-admissions*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Patient Admissions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/patient-admissions*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('employee/patient-admissions') }}">
            <span class="menu-title">{{ __('messages.patient_admissions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('patient/my-prescriptions*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Prescriptions',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient/my-prescriptions*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('prescriptions.list') }}">
            <span class="menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('patient/my-vaccinated*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Vaccinated Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient/my-vaccinated*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient.vaccinated') }}">
            <span class="menu-title">{{ __('messages.vaccinated_patients') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
@role('Patient')
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('patient/my-ipds*','opds*','patient/my-opds*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @module('IPD Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('patient/my-ipds*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient.ipd') }}">
            <span class="menu-title">{{ __('messages.ipd_patients') }}</span>
        </a>
    </div>
    @endmodule
    @module('OPD Patients',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('opds*','patient/my-opds*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ route('patient.opd') }}">
            <span class="menu-title">{{ __('messages.opd_patients') }}</span>
        </a>
    </div>
    @endmodule
</div>
@endrole
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/patient-diagnosis-test*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Diagnosis Tests',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/patient-diagnosis-test*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('employee/patient-diagnosis-test') }}">
            <span class="menu-title">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/invoices*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Invoices',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/invoices*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('employee/invoices') }}">
            <span class="menu-title">{{ __('messages.invoices') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>
<div
    class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('employee/bills*')) ? 'd-none' : '' }}"
    id="#kt_header_menu" data-kt-menu="true">
    @role('Patient')
    @module('Bills',$modules)
    <div class="menu-item me-lg-1 {{ Request::is('employee/bills*') ? 'show' : '' }}">
        <a class="menu-link py-3"
           href="{{ url('employee/bills') }}">
            <span class="menu-title">{{ __('messages.bills') }}</span>
        </a>
    </div>
    @endmodule
    @endrole
</div>

@role('Super Admin')
{{-- Super Admin Dashboard Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/dashboard*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/dashboard*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.dashboard') }}">
            <span class="menu-title">{{ __('messages.dashboard.dashboard') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Users Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/hospitals*', 'super-admin/hospital*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/hospitals*', 'super-admin/hospital*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.hospitals.index') }}">
            <span class="menu-title">{{ __('messages.hospitals') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Subscription Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/subscription-plans*', 'super-admin/transactions*', 'super-admin/subscriptions-hospitals*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/subscription-plans*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.subscription.plans.index') }}">
            <span class="menu-title">{{ __('messages.subscription_plans.subscription_plans') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/transactions*') ? 'show' : ''  }}">
        <a class="menu-link py-3 {{ Request::is('super-admin/transactions*') ? 'active' : '' }}"
           href="{{ route('subscriptions.transactions.index') }}">
            <span class="menu-title">{{ __('messages.subscription_plans.transactions') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/subscriptions-hospitals*') ? 'show' : ''  }}">
        <a class="menu-link py-3 {{ Request::is('super-admin/subscriptions-hospitals*') ? 'active' : '' }}"
           href="{{ route('subscriptions.list.index') }}">
            <span class="menu-title">{{ __('messages.subscription.subscriptions') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Landing CMS Section One Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/section-one*','super-admin/section-two*','super-admin/section-three*','super-admin/section-four*','super-admin/section-five*','super-admin/about-us*','super-admin/service-slider*','super-admin/faqs*','super-admin/admin-testimonial*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/section-one*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.section.one') }}">
            <span class="menu-title">{{ __('messages.landing_cms.section_one') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/section-two*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.section.two') }}">
            <span class="menu-title">{{ __('messages.landing_cms.section_two') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/section-three*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.section.three') }}">
            <span class="menu-title">{{ __('messages.landing_cms.section_three') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/section-four*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.section.four') }}">
            <span class="menu-title">{{ __('messages.landing_cms.section_four') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/section-five*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.section.five') }}">
            <span class="menu-title">{{ __('messages.landing_cms.section_five') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/about-us*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.about.us') }}">
            <span class="menu-title">{{ __('messages.landing_cms.about_us') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/service-slider*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('service-slider.index') }}">
            <span class="menu-title">{{ __('messages.web_home.services') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/faqs*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('faqs.index') }}">
            <span class="menu-title">{{ __('messages.faqs.faqs') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/admin-testimonial') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('admin-testimonial.index') }}">
            <span class="menu-title">{{ __('messages.testimonials') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Settings Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/general-settings*','super-admin/footer-settings*')) ? 'd-none' : '' }}" id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/general-settings*') ? 'show' : ''  }}">
        <a class="menu-link py-3 " href="{{ route('super.admin.settings.edit') }}">
            <span class="menu-title">{{ __('messages.settings') }}</span>
        </a>
    </div>
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/footer-settings*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.footer.settings.edit') }}">
            <span class="menu-title">{{ __('messages.footer_setting.footer_settings') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Subscribe Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/subscriber*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/subscriber*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.subscribe.index') }}">
            <span class="menu-title">{{ __('messages.subscribe.subscribers') }}</span>
        </a>
    </div>
</div>

{{-- Super Admin Enquiry Sub Menu --}}
<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch {{ (!Request::is('super-admin/enquiries*')) ? 'd-none' : '' }}"
     id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1 {{ Request::is('super-admin/enquiries*') ? 'show' : ''  }}">
        <a class="menu-link py-3 "
           href="{{ route('super.admin.enquiry.index') }}">
            <span class="menu-title">{{ __('messages.enquiries') }}</span>
        </a>
    </div>
</div>

@endrole
