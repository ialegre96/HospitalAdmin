<?php

namespace Database\Seeders;

use App\Models\DiagnosisCategory;
use Illuminate\Database\Seeder;

class DiagnosisCategorySeeder extends Seeder
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
                'name' => 'Nervous System',
            ],
            [
                'name' => 'Eye',
            ],
            [
                'name' => 'Ear, Nose, Mouth, And Throat',
            ],
            [
                'name' => 'Respiratory System',
            ],
            [
                'name' => 'Circulatory System',
            ],
            [
                'name' => 'Digestive System',
            ],
            [
                'name' => 'Hepatobiliary System and Pancreas',
            ],
            [
                'name' => 'Musculoskeletal System and Connective Tissue',
            ],
            [
                'name' => 'Skin, Subcutaneous Tissue, and Breast',
            ],
            [
                'name' => 'Endocrine, Nutritional, and Metabolic System',
            ],
            [
                'name' => 'Kidney and Urinary Tract',
            ],
            [
                'name' => 'Male Reproductive System',
            ],
            [
                'name' => 'Female Reproductive System',
            ],
            [
                'name' => 'Pregnancy, Childbirth, and Puerperium',
            ],
            [
                'name' => 'Newborn and Other Neonates (Perinatal Period)',
            ],
            [
                'name' => 'Blood and Blood Forming Organs and Immunological Disorders',
            ],
            [
                'name' => 'Myeloproliferative Diseases and Disorders (Poorly Differentiated Neoplasms)',
            ],
            [
                'name' => 'Infectious and Parasitic Diseases and Disorders',
            ],
            [
                'name' => 'Mental Diseases and Disorders',
            ],
            [
                'name' => 'Alcohol/Drug Use or Induced Mental Disorders',
            ],
            [
                'name' => 'Injuries, Poison, and Toxic Effect of Drugs',
            ],
            [
                'name' => 'Burns',
            ],
            [
                'name' => 'Factors Influencing Health Status',
            ],
            [
                'name' => 'Multiple Significant Trauma',
            ],
            [
                'name' => 'Human Immunodeficiency Virus (HIV) Infection',
            ],

        ];

        foreach ($input as $data) {
            DiagnosisCategory::create($data);
        }
    }
}
