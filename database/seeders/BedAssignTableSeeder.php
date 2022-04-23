<?php

namespace Database\Seeders;

use App\Models\BedAssign;
use App\Models\PatientCase;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BedAssignTableSeeder extends Seeder
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
                'bed_id'         => 1,
                'patient_id'     => 1,
                'case_id'        => PatientCase::select('case_id')->skip(0)->value('case_id'),
                'assign_date'    => Carbon::now(),
                'discharge_date' => Carbon::parse(Carbon::now())->addDays(3),
                'status'         => 1,
            ],
            [
                'bed_id'         => 2,
                'patient_id'     => 2,
                'case_id'        => PatientCase::select('case_id')->skip(1)->value('case_id'),
                'assign_date'    => Carbon::now(),
                'discharge_date' => Carbon::parse(Carbon::now())->addDays(4),
                'status'         => 1,
            ],
        ];

        foreach ($input as $data) {
            BedAssign::create($data);
        }
    }
}
