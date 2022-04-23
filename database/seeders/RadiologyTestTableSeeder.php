<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\RadiologyTest;
use Illuminate\Database\Seeder;

class RadiologyTestTableSeeder extends Seeder
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
                'test_name'          => 'Magnetic Resonance Angiography',
                'short_name'         => 'MRA',
                'test_type'          => 'MRA',
                'category_id'        => 1,
                'subcategory'        => null,
                'report_days'        => 1,
                'charge_category_id' => 1,
                'standard_charge'    => Charge::where('charge_category_id', 1)->value('standard_charge'),
            ],
            [
                'test_name'          => 'Exercise EKG (stress test)',
                'short_name'         => 'EEST',
                'test_type'          => 'EEST',
                'category_id'        => 2,
                'subcategory'        => null,
                'report_days'        => 2,
                'charge_category_id' => 2,
                'standard_charge'    => Charge::where('charge_category_id', 2)->value('standard_charge'),
            ],
        ];

        foreach ($input as $data) {
            RadiologyTest::create($data);
        }
    }
}
