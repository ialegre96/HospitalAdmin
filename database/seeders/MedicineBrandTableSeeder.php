<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class MedicineBrandTableSeeder extends Seeder
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
                'name' => 'Atcuron',
            ],
            [
                'name' => 'Benadryl',
            ],
            [
                'name' => 'Calbeta',
            ],
            [
                'name' => 'Supradyn',
            ],
            [
                'name' => 'Tolol-H',
            ],
        ];

        foreach ($input as $data) {
            Brand::create($data);
        }
    }
}
