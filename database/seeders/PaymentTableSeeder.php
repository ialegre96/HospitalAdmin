<?php

namespace Database\Seeders;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
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
                'payment_date' => Carbon::now(),
                'account_id'   => 1,
                'pay_to'       => 'Pranami Labs',
                'description'  => 'This is the payment to Pranami Labs',
                'amount'       => 1000,
            ],
            [
                'payment_date' => Carbon::now(),
                'account_id'   => 2,
                'pay_to'       => 'Prakash Labs',
                'description'  => 'This is the payment Prakash Labs',
                'amount'       => 2000,
            ],
        ];

        foreach ($input as $data) {
            Payment::create($data);
        }
    }
}
