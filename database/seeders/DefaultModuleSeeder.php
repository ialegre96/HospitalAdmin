<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class DefaultModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        $input = [
            [
                'name'      => 'Patients',
                'is_active' => 1,
                'route'     => 'patients.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Doctors',
                'is_active' => 1,
                'route'     => 'doctors.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Accountants',
                'is_active' => 1,
                'route'     => 'accountants.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Medicines',
                'is_active' => 1,
                'route'     => 'medicines.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Nurses',
                'is_active' => 1,
                'route'     => 'nurses.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Receptionists',
                'is_active' => 1,
                'route'     => 'receptionists.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Lab Technicians',
                'is_active' => 1,
                'route'     => 'lab-technicians.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Pharmacists',
                'is_active' => 1,
                'route'     => 'pharmacists.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Birth Reports',
                'is_active' => 1,
                'route'     => 'birth-reports.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Death Reports',
                'is_active' => 1,
                'route'     => 'death-reports.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Investigation Reports',
                'is_active' => 1,
                'route'     => 'investigation-reports.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Operation Reports',
                'is_active' => 1,
                'route'     => 'operation-reports.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Income',
                'is_active' => 1,
                'route'     => 'incomes.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Expense',
                'is_active' => 1,
                'route'     => 'expenses.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'SMS',
                'is_active' => 1,
                'route'     => 'sms.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'IPD Patients',
                'is_active' => 1,
                'route'     => 'ipd.patient.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'OPD Patients',
                'is_active' => 1,
                'route'     => 'opd.patient.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Accounts',
                'is_active' => 1,
                'route'     => 'accounts.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Employee Payrolls',
                'is_active' => 1,
                'route'     => 'employee-payrolls.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Invoices',
                'is_active' => 1,
                'route'     => 'invoices.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,

            ],
            [
                'name'      => 'Payments',
                'is_active' => 1,
                'route'     => 'payments.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Payment Reports',
                'is_active' => 1,
                'route'     => 'payment.reports',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Advance Payments',
                'is_active' => 1,
                'route'     => 'advanced-payments.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Bills',
                'is_active' => 1,
                'route'     => 'bills.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Bed Types',
                'is_active' => 1,
                'route'     => 'bed-types.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Beds',
                'is_active' => 1,
                'route'     => 'beds.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Bed Assigns',
                'is_active' => 1,
                'route'     => 'bed-assigns.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Blood Banks',
                'is_active' => 1,
                'route'     => 'blood-banks.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Blood Donors',
                'is_active' => 1,
                'route'     => 'blood-donors.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Documents',
                'is_active' => 1,
                'route'     => 'documents.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Document Types',
                'is_active' => 1,
                'route'     => 'document-types.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Services',
                'is_active' => 1,
                'route'     => 'services.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Insurances',
                'is_active' => 1,
                'route'     => 'insurances.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Packages',
                'is_active' => 1,
                'route'     => 'packages.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Ambulances',
                'is_active' => 1,
                'route'     => 'ambulances.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Ambulances Calls',
                'is_active' => 1,
                'route'     => 'ambulance-calls.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Appointments',
                'is_active' => 1,
                'route'     => 'appointments.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Call Logs',
                'is_active' => 1,
                'route'     => 'call_logs.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Visitors',
                'is_active' => 1,
                'route'     => 'visitors.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Postal Receive',
                'is_active' => 1,
                'route'     => 'receives.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Postal Dispatch',
                'is_active' => 1,
                'route'     => 'dispatches.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Notice Boards',
                'is_active' => 1,
                'route'     => 'noticeboard',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Mail',
                'is_active' => 1,
                'route'     => 'mail',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Enquires',
                'is_active' => 1,
                'route'     => 'enquiries',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Charge Categories',
                'is_active' => 1,
                'route'     => 'charge-categories.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Charges',
                'is_active' => 1,
                'route'     => 'charges.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Doctor OPD Charges',
                'is_active' => 1,
                'route'     => 'doctor-opd-charges.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Items Categories',
                'is_active' => 1,
                'route'     => 'item-categories.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Items',
                'is_active' => 1,
                'route'     => 'items.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Item Stocks',
                'is_active' => 1,
                'route'     => 'item.stock.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Issued Items',
                'is_active' => 1,
                'route'     => 'issued.item.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Diagnosis Categories',
                'is_active' => 1,
                'route'     => 'diagnosis.category.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Diagnosis Tests',
                'is_active' => 1,
                'route'     => 'patient.diagnosis.test.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Pathology Categories',
                'is_active' => 1,
                'route'     => 'pathology.category.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Pathology Tests',
                'is_active' => 1,
                'route'     => 'pathology.test.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Radiology Categories',
                'is_active' => 1,
                'route'     => 'radiology.category.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Radiology Tests',
                'is_active' => 1,
                'route'     => 'radiology.test.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Medicine Categories',
                'is_active' => 1,
                'route'     => 'categories.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Medicine Brands',
                'is_active' => 1,
                'route'     => 'brands.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Doctor Departments',
                'is_active' => 1,
                'route'     => 'doctor-departments.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Schedules',
                'is_active' => 1,
                'route'     => 'schedules.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Prescriptions',
                'is_active' => 1,
                'route'     => 'prescriptions.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Cases',
                'is_active' => 1,
                'route'     => 'patient-cases.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Case Handlers',
                'is_active' => 1,
                'route'     => 'case-handlers.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Patient Admissions',
                'is_active' => 1,
                'route'     => 'patient-admissions.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'My Payrolls',
                'is_active' => 1,
                'route'     => 'payroll',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Patient Cases',
                'is_active' => 1,
                'route'     => 'patients.cases',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Testimonial',
                'is_active' => 1,
                'route'     => 'testimonials.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Blood Donations',
                'is_active' => 1,
                'route'     => 'blood-donations.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Blood Issues',
                'is_active' => 1,
                'route'     => 'blood-issues.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Live Consultations',
                'is_active' => 1,
                'route'     => 'live.consultation.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Live Meetings',
                'is_active' => 1,
                'route'     => 'live.meeting.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Vaccinated Patients',
                'is_active' => 1,
                'route'     => 'vaccinated-patients.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
            [
                'name'      => 'Vaccinations',
                'is_active' => 1,
                'route'     => 'vaccinations.index',
                'tenant_id' => $userTenantId != null ? $userTenantId : null,
            ],
        ];
        foreach ($input as $data) {
            $module = Module::whereName($data['name'])->whereTenantId($data['tenant_id'])->first();
            if ($module) {
                $module->update(['route' => $data['route']]);
            } else {
                Module::create($data);
            }
        }
    }
}
