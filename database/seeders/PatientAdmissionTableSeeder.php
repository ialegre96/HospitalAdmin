<?php

namespace Database\Seeders;

use App\Models\PatientAdmission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PatientAdmissionTableSeeder extends Seeder
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
                'patient_admission_id' => mb_strtoupper(PatientAdmission::generateUniquePatientId()),
                'patient_id'           => 1,
                'doctor_id'            => 1,
                'admission_date'       => Carbon::now(),
                'discharge_date'       => Carbon::parse(Carbon::now())->addDays(4),
                'package_id'           => 1,
                'insurance_id'         => 1,
                'bed_id'               => 1,
                'status'               => 1,
            ],
            [
                'patient_admission_id' => mb_strtoupper(PatientAdmission::generateUniquePatientId()),
                'patient_id'           => 2,
                'doctor_id'            => 2,
                'admission_date'       => Carbon::now(),
                'discharge_date'       => Carbon::parse(Carbon::now())->addDays(5),
                'package_id'           => 2,
                'insurance_id'         => 2,
                'bed_id'               => 2,
                'status'               => 1,
            ],
        ];

        foreach ($input as $data) {
            PatientAdmission::create($data);
        }
    }
}
