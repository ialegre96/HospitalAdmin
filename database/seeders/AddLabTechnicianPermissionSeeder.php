<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class AddLabTechnicianPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'manage_lab_technicians']);

        /** @var Department $adminRole */
        $adminRole = Department::whereName('Admin')->first();
        $adminRole->givePermissionTo($permission);

        /** @var Department $receptionistRole */
        $receptionistRole = Department::whereName('Receptionist')->first();
        $receptionistRole->givePermissionTo($permission);
    }
}
