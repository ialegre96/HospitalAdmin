<?php

namespace Database\Seeders;

use App\Models\BloodDonor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BloodDonorTableSeeder extends Seeder
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
                'name'             => 'Jenil Savani',
                'age'              => 20,
                'gender'           => 0,
                'blood_group'      => 'B+',
                'last_donate_date' => Carbon::parse(Carbon::now())->subDays(4),
            ],
            [
                'name'             => 'Vishal Ribadiya',
                'age'              => 20,
                'gender'           => 0,
                'blood_group'      => 'AB+',
                'last_donate_date' => Carbon::parse(Carbon::now())->subDays(4),
            ],
        ];

        foreach ($input as $data) {
            BloodDonor::create($data);
        }
    }
}
