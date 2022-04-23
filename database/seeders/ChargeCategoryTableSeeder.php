<?php

namespace Database\Seeders;

use App\Models\ChargeCategory;
use Illuminate\Database\Seeder;

class ChargeCategoryTableSeeder extends Seeder
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
                'name'        => 'Blood pressure check',
                'description' => 'BP',
                'charge_type' => 1,
            ],
            [
                'name'        => 'Valvular surgery',
                'description' => 'Valvular surgery',
                'charge_type' => 2,
            ],
        ];

        foreach ($input as $data) {
            ChargeCategory::create($data);
        }
    }
}
