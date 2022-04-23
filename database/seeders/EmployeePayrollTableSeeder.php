<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\Nurse;
use App\Models\PatientCase;
use Illuminate\Database\Seeder;

class EmployeePayrollTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'sr_no'        => 1,
                'payroll_id'   => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'type'         => 2,
                'owner_id'     => 1,
                'owner_type'   => Doctor::class,
                'month'        => 'January',
                'year'         => 2020,
                'net_salary'   => 1000,
                'status'       => 1,
                'basic_salary' => 900,
                'allowance'    => 200,
                'deductions'   => 100,
            ],
            [
                'sr_no'        => 2,
                'payroll_id'   => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'type'         => 1,
                'owner_id'     => 1,
                'owner_type'   => Nurse::class,
                'month'        => 'January',
                'year'         => 2020,
                'net_salary'   => 1000,
                'status'       => 1,
                'basic_salary' => 900,
                'allowance'    => 200,
                'deductions'   => 100,
            ],
        ];

        foreach ($input as $data) {
            EmployeePayroll::create($data);
        }
    }
}
