<?php

namespace Database\Seeders;

use App\Models\PatientCase;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CaseTableSeeder extends Seeder
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
                'case_id'    => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'patient_id' => 1,
                'doctor_id'  => 1,
                'date'       => Carbon::now(),
                'status'     => 1,
                'fee'        => 100,
            ],
            [
                'case_id'    => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'patient_id' => 1,
                'doctor_id'  => 2,
                'date'       => Carbon::now(),
                'status'     => 1,
                'fee'        => 100,
            ],
        ];

        foreach ($input as $data) {
            PatientCase::create($data);
        }
    }
}
