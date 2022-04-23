<?php

namespace Database\Seeders;

use App\Repositories\AccountantRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class AccountantTableSeeder extends Seeder
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
                'first_name'        => 'Ekta',
                'last_name'         => 'Malviya',
                'email'             => 'ekta@gmail.com',
                'gender'            => 0,
                'password'          => 123456,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            /*
            [
                'first_name'        => 'Bhumi',
                'last_name'         => 'Khimani',
                'email'             => 'bhumi@gmail.com',
                'gender'            => 0,
                'password'          => 123456,
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            */
        ];

        foreach ($input as $key => $value) {
            /** @var AccountantRepository $accountant */
            $accountant = App::make(AccountantRepository::class);
            $accountant->store($input[$key], false);
        }
    }
}
