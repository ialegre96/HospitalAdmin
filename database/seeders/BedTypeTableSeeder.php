<?php

namespace Database\Seeders;

use App\Models\BedType;
use Illuminate\Database\Seeder;

class BedTypeTableSeeder extends Seeder
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
                'title'       => 'ICU',
                'description' => 'This is the ICU bed',
            ],
            [
                'title'       => 'NICU',
                'description' => 'This is the NICU bed',
            ],
            [
                'title'       => 'VIP Ward',
                'description' => 'This is the VIP Ward bed',
            ],
            [
                'title'       => 'Private Ward',
                'description' => 'This is the Private Ward bed',
            ],
            [
                'title'       => 'General Ward Female',
                'description' => 'This is the General Ward Female bed',
            ],
            [
                'title'       => 'General Ward Male',
                'description' => 'General Ward Male',
            ],
        ];

        foreach ($input as $data) {
            BedType::create($data);
        }
    }
}
