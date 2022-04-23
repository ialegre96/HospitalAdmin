<?php

namespace Database\Seeders;

use App\Models\Charge;
use Illuminate\Database\Seeder;

class ChargeTableSeeder extends Seeder
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
                'charge_type'        => 1,
                'charge_category_id' => 1,
                'code'               => 'Ang1',
                'standard_charge'    => 40,
                'description'        => null,
            ],
            [
                'charge_type'        => 2,
                'charge_category_id' => 2,
                'code'               => 'oxg1',
                'standard_charge'    => 20,
                'description'        => null,
            ],
        ];

        foreach ($input as $data) {
            Charge::create($data);
        }
    }
}
