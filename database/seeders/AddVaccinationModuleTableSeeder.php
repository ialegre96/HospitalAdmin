<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class AddVaccinationModuleTableSeeder extends Seeder
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
                'name'      => 'Vaccinations',
                'is_active' => 1,
                'route'     => 'vaccinations.index',
            ],
            [
                'name'      => 'Vaccinated Patients',
                'is_active' => 1,
                'route'     => 'vaccinated-patients.index',
            ],
        ];

        foreach ($input as $data) {
            Module::create($data);
        }
    }
}
