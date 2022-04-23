<?php

namespace Database\Seeders;

use App\Models\PathologyCategory;
use Illuminate\Database\Seeder;

class PathologyCategoryTableSeeder extends Seeder
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
                'name' => 'Clinical Microbiology',
            ],
            [
                'name' => 'Clinical Chemistry',
            ],
            [
                'name' => 'Hematology',
            ],
            [
                'name' => 'Molecular Diagnostics',
            ],
            [
                'name' => 'Reproductive Biology',
            ],
        ];

        foreach ($input as $data) {
            PathologyCategory::create($data);
        }
    }
}
