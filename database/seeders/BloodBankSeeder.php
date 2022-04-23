<?php

namespace Database\Seeders;

use App\Models\BloodBank;
use Illuminate\Database\Seeder;

class BloodBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            ['blood_group' => 'A+', 'remained_bags' => 0],
            ['blood_group' => 'A-', 'remained_bags' => 0],
            ['blood_group' => 'B+', 'remained_bags' => 0],
            ['blood_group' => 'B-', 'remained_bags' => 0],
            ['blood_group' => 'AB+', 'remained_bags' => 0],
            ['blood_group' => 'AB-', 'remained_bags' => 0],
            ['blood_group' => 'O+', 'remained_bags' => 0],
            ['blood_group' => 'O-', 'remained_bags' => 0],
        ];

        foreach ($input as $data) {
            BloodBank::create($data);
        }
    }
}
