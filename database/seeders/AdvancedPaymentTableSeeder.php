<?php

namespace Database\Seeders;

use App\Models\AdvancedPayment;
use App\Models\PatientCase;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdvancedPaymentTableSeeder extends Seeder
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
                'patient_id' => 1,
                'receipt_no' => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'amount'     => 1000,
                'date'       => Carbon::now(),
            ],
            [
                'patient_id' => 2,
                'receipt_no' => mb_strtoupper(PatientCase::generateUniqueCaseId()),
                'amount'     => 1500,
                'date'       => Carbon::now(),
            ],
        ];

        foreach ($input as $data) {
            AdvancedPayment::create($data);
        }
    }
}
