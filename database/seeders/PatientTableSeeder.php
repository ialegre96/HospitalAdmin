<?php

namespace Database\Seeders;

use App\Repositories\PatientRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class PatientTableSeeder extends Seeder
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
                'first_name'        => 'Tirth',
                'last_name'         => 'Patil',
                'email'             => 'tirth@gmail.com',
                'password'          => '123456',
                'gender'            => 0,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            /*
            [
                'first_name'        => 'Pravin',
                'last_name'         => 'Parekh',
                'email'             => 'pravin@gmail.com',
                'password'          => '123456',
                'gender'            => 0,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            */
        ];

        foreach ($input as $key => $value) {
            /** @var PatientRepository $patient */
            $patient = App::make(PatientRepository::class);
            $patient->store($input[$key], false);
        }
    }
}
