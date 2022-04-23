<?php

namespace Database\Seeders;

use App\Models\DoctorDepartment;
use Illuminate\Database\Seeder;

class DoctorDepartmentTableSeeder extends Seeder
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
                'title' => 'Cardiologists',
            ],
            [
                'title' => 'Endocrinologists',
            ],
            [
                'title' => 'Allergists',
            ],
            [
                'title' => 'Dermatologists',
            ],
            [
                'title' => 'Ophthalmologists',
            ],
            [
                'title' => 'Nephrologists',
            ],
        ];

        foreach ($input as $data) {
            DoctorDepartment::create($data);
        }
    }
}
