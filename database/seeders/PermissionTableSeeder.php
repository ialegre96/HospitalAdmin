<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'manage_users',
            'manage_beds',
            'manage_wards',
            'manage_appointments',
            'manage_prescriptions',
            'manage_patients',
            'manage_blood_bank',
            'manage_reports',
            'manage_payrolls',
            'manage_settings',
            'manage_notice_board',
            'manage_doctors',
            'manage_nurses',
            'manage_receptionists',
            'manage_pharmacists',
            'manage_accountants',
            'manage_invoices', 'manage_operations_history',
            'manage_admit_history',
            'manage_blood_donor',
            'manage_medicines',
            'manage_department',
            'manage_doctor_departments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
