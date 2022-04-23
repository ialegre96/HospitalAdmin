<?php

namespace Database\Seeders;

use App\Repositories\NurseRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class NurseTableSeeder extends Seeder
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
                'first_name'        => 'Pravina',
                'last_name'         => 'Makvana',
                'email'             => 'pravina@gmail.com',
                'password'          => '123456',
                'designation'       => 'Nurse',
                'gender'            => 1,
                'qualification'     => 'BCom',
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            /*
            [
                'first_name'        => 'Priti',
                'last_name'         => 'Lad',
                'email'             => 'priti@gmail.com',
                'password'          => '123456',
                'designation'       => 'Nurse',
                'gender'            => 1,
                'qualification'     => 'BCom',
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            */
        ];

        foreach ($input as $key => $value) {
            /** @var NurseRepository $nurse */
            $nurse = App::make(NurseRepository::class);
            $nurse->store($input[$key], false);
        }
    }
}
