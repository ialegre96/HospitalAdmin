<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
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
                'name'        => 'HMS Debit Account',
                'type'        => 1,
                'description' => 'This is the savings account',
                'status'      => 1,
            ],
            [
                'name'        => 'HMS Credit Account',
                'type'        => 2,
                'description' => 'This is the current account',
                'status'      => 1,
            ],
        ];

        foreach ($input as $data) {
            Account::create($data);
        }
    }
}
