<?php

namespace Database\Seeders;

use App\Repositories\ReceptionistRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ReceptionistTableSeeder extends Seeder
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
                'first_name'        => 'Ashok',
                'last_name'         => 'Patel',
                'email'             => 'ashok@gmail.com',
                'password'          => '123456',
                'designation'       => 'Receptionist',
                'qualification'     => 'MCom',
                'gender'            => 0,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            /*
            [
                'first_name'        => 'Khushboo',
                'last_name'         => 'Naik',
                'email'             => 'khushboo@gmail.com',
                'password'          => '123456',
                'designation'       => 'Receptionist',
                'qualification'     => 'MCom',
                'gender'            => 0,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            */
        ];

        foreach ($input as $key => $value) {
            /** @var ReceptionistRepository $receptionist */
            $receptionist = App::make(ReceptionistRepository::class);
            $receptionist->store($input[$key], false);
        }
    }
}
