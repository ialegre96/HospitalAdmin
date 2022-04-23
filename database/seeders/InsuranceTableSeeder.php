<?php

namespace Database\Seeders;

use App\Repositories\InsuranceRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class InsuranceTableSeeder extends Seeder
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
                'name'           => 'Senior Citizen Health Insurance',
                'service_tax'    => 10,
                'insurance_no'   => 'INS-1',
                'insurance_code' => 'INSC-1',
                'hospital_rate'  => 1000,
                'status'         => 1,
                'total'          => 1410,
                'disease_name'   => [
                    0 => 'Heart Disease',
                    1 => 'Infectious Diseases',
                ],
                'disease_charge' => [
                    0 => 100,
                    1 => 300,
                ],
            ],
            [
                'name'           => 'Critical Illness Insurance',
                'service_tax'    => 20,
                'insurance_no'   => 'INS-2',
                'insurance_code' => 'INSC-2',
                'hospital_rate'  => 1000,
                'status'         => 1,
                'total'          => 1620,
                'disease_name'   => [
                    0 => 'Liver Disease',
                    1 => 'Celiac Disease',
                ],
                'disease_charge' => [
                    0 => 200,
                    1 => 400,
                ],
            ],
        ];

        foreach ($input as $key => $value) {
            /** @var InsuranceRepository $insurance */
            $insurance = App::make(InsuranceRepository::class);
            $insurance->store($input[$key]);
        }
    }
}
