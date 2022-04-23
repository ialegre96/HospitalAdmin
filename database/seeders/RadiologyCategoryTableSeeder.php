<?php

namespace Database\Seeders;

use App\Models\RadiologyCategory;
use Illuminate\Database\Seeder;

class RadiologyCategoryTableSeeder extends Seeder
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
                'name' => 'X-Ray',
            ],
            [
                'name' => 'Sonography',
            ],
            [
                'name' => 'CT Scan',
            ],
            [
                'name' => 'MRI',
            ],
            [
                'name' => 'ECG',
            ],
        ];

        foreach ($input as $data) {
            RadiologyCategory::create($data);
        }
    }
}
