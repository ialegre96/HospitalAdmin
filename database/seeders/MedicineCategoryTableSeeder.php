<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class MedicineCategoryTableSeeder extends Seeder
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
                'name'      => 'Antipyretics',
                'is_active' => 1,
            ],
            [
                'name'      => 'Analgesics',
                'is_active' => 1,
            ],
            [
                'name'      => 'Antimalarial',
                'is_active' => 1,
            ],
            [
                'name'      => 'Antibiotics',
                'is_active' => 1,
            ],
            [
                'name'      => 'Antiseptics',
                'is_active' => 1,
            ],
        ];

        foreach ($input as $data) {
            Category::create($data);
        }
    }
}
