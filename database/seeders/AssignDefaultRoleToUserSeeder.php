<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignDefaultRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Department $superAdminRole */
        $superAdminRole = Department::whereName('Super Admin')->first();
        /** @var Department $adminRole */
        $adminRole = Department::whereName('Admin')->first();
        /** @var Department $doctorRole */
        $doctorRole = Department::whereName('Doctor')->first();
        /** @var Department $patientRole */
        $patientRole = Department::whereName('Patient')->first();
        /** @var Department $nurseRole */
        $nurseRole = Department::whereName('Nurse')->first();
        /** @var Department $receptionistRole */
        $receptionistRole = Department::whereName('Receptionist')->first();
        /** @var Department $pharmacistRole */
        $pharmacistRole = Department::whereName('Pharmacist')->first();
        /** @var Department $accountantRole */
        $accountantRole = Department::whereName('Accountant')->first();

        $adminPermissions = Permission::all();
        $superAdminRole->givePermissionTo($adminPermissions);
        $adminRole->givePermissionTo($adminPermissions);

        $doctorPermissions = Permission::whereIn(
            'name',
            [
                'manage_appointments', 'manage_prescriptions', 'manage_patients', 'manage_blood_bank', 'manage_reports',
                'manage_notice_board', 'manage_doctors', 'manage_nurses', 'manage_receptionists', 'manage_pharmacists',
                'manage_operations_history', 'manage_blood_donor',
                'manage_medicines', 'manage_department',
            ]
        )->get();
        $doctorRole->givePermissionTo($doctorPermissions);

        $patientPermissions = Permission::whereIn(
            'name',
            [
                'manage_appointments', 'manage_prescriptions', 'manage_blood_bank', 'manage_reports',
                'manage_notice_board', 'manage_doctors', 'manage_nurses', 'manage_receptionists',
                'manage_pharmacists', 'manage_medicines', 'manage_admit_history',
            ]
        )->get();
        $patientRole->givePermissionTo($patientPermissions);

        $nursePermissions = Permission::whereIn(
            'name',
            [
                'manage_beds', 'manage_wards', 'manage_appointments', 'manage_prescriptions', 'manage_patients',
                'manage_blood_bank', 'manage_reports', 'manage_notice_board', 'manage_doctors', 'manage_nurses',
                'manage_receptionists', 'manage_pharmacists', 'manage_operations_history',
                'manage_blood_donor', 'manage_medicines', 'manage_department',
            ]
        )->get();
        $nurseRole->givePermissionTo($nursePermissions);

        $receptionistPermissions = Permission::whereIn(
            'name',
            [
                'manage_beds', 'manage_wards', 'manage_appointments', 'manage_patients', 'manage_blood_bank',
                'manage_reports', 'manage_notice_board', 'manage_doctors', 'manage_nurses', 'manage_receptionists',
                'manage_pharmacists', 'manage_operations_history', 'manage_admit_history',
                'manage_blood_donor', 'manage_department',
            ]
        )->get();
        $receptionistRole->givePermissionTo($receptionistPermissions);

        $pharmacistPermissions = Permission::whereIn(
            'name',
            ['manage_notice_board', 'manage_pharmacists', 'manage_medicines']
        )->get();
        $pharmacistRole->givePermissionTo($pharmacistPermissions);

        $accountantPermissions = Permission::whereIn(
            'name',
            ['manage_notice_board', 'manage_pharmacists', 'manage_medicines']
        )->get();
        $accountantRole->givePermissionTo($accountantPermissions);

        $roleIds = [];
        if (! empty($superAdminRole)) {
            $roleIds = $superAdminRole->id;
        }

        /** @var User $user */
        $user = User::first();
        $user->roles()->sync($roleIds);
    }
}
