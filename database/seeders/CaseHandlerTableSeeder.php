<?php

namespace Database\Seeders;

use App\Repositories\CaseHandlerRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CaseHandlerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            /*
            [
                'first_name'        => 'Ashish',
                'last_name'         => 'Nakrani',
                'email'             => 'ashish@gmail.com',
                'password'          => '123456',
                'designation'       => 'Case Handler',
                'gender'            => 0,
                'qualification'     => 'LLB',
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
            */
            [
                'first_name'        => 'Ajay',
                'last_name'         => 'Makwana',
                'email'             => 'ajay@gmail.com',
                'password'          => '123456',
                'designation'       => 'Case Handler',
                'gender'            => 0,
                'qualification'     => 'LLB',
                'status'            => 1,
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($input as $key => $value) {
            /** @var CaseHandlerRepository $caseHandler */
            $caseHandler = App::make(CaseHandlerRepository::class);
            $caseHandler->store($input[$key], false);
        }
    }
}
