<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineTableSeeder extends Seeder
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
                'category_id'      => 1,
                'brand_id'         => 1,
                'name'             => 'Aciclovir',
                'selling_price'    => 90,
                'buying_price'     => 120,
                'side_effects'     => 'As directed by the Physician',
                'description'      => 'It\'s a Anti-viral tablets.',
                'salt_composition' => 'aciclovir',
            ],
            [
                'category_id'      => 2,
                'brand_id'         => 2,
                'name'             => 'Atenolol',
                'selling_price'    => 190,
                'buying_price'     => 220,
                'side_effects'     => 'As directed by the Physician',
                'description'      => 'It\'s a hypertension and angina and in stable heart attack patients to prevent death.',
                'salt_composition' => 'atenolol',
            ],
            [
                'category_id'      => 3,
                'brand_id'         => 3,
                'name'             => 'Amlodipine Olmesartan',
                'selling_price'    => 30,
                'buying_price'     => 70,
                'side_effects'     => 'As directed by the Physician',
                'description'      => 'It\'s a combination medicine used to treat high blood pressure (hypertension).',
                'salt_composition' => 'amlodipine olmesartan',
            ],
            [
                'category_id'      => 4,
                'brand_id'         => 4,
                'name'             => 'Camylofin',
                'selling_price'    => 50,
                'buying_price'     => 90,
                'side_effects'     => 'As directed by the Physician',
                'description'      => 'It\'s an antimuscarinic drug that also causes direct smooth muscle relaxation.',
                'salt_composition' => 'camylofin',
            ],
            [
                'category_id'      => 5,
                'brand_id'         => 5,
                'name'             => 'Unidex',
                'selling_price'    => 120,
                'buying_price'     => 160,
                'side_effects'     => 'As directed by the Physician',
                'description'      => 'It\'s a drug which is used at the time of depression.',
                'salt_composition' => 'unidex',
            ],
        ];

        foreach ($input as $data) {
            Medicine::create($data);
        }
    }
}
