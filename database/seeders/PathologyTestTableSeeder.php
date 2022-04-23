<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\PathologyTest;
use Illuminate\Database\Seeder;

class PathologyTestTableSeeder extends Seeder
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
                'test_name'          => 'Exercise EKG (stress test)',
                'short_name'         => 'EEST',
                'test_type'          => 'EEST',
                'category_id'        => 1,
                'unit'               => 3,
                'subcategory'        => null,
                'method'             => null,
                'report_days'        => 1,
                'charge_category_id' => 1,
                'standard_charge'    => Charge::where('charge_category_id', 1)->value('standard_charge'),
            ],
            [
                'test_name'          => 'Lungs X-rays',
                'short_name'         => 'L',
                'test_type'          => 'L',
                'category_id'        => 2,
                'unit'               => 9,
                'subcategory'        => null,
                'method'             => null,
                'report_days'        => 2,
                'charge_category_id' => 2,
                'standard_charge'    => Charge::where('charge_category_id', 2)->value('standard_charge'),
            ],
        ];

        foreach ($input as $data) {
            PathologyTest::create($data);
        }
    }
}
