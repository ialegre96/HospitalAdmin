<?php

namespace Database\Seeders;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExpenseTableSeeder extends Seeder
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
                'expense_head'   => 1,
                'name'           => 'Whoop Vega',
                'invoice_number' => 'TDX124',
                'date'           => Carbon::now(),
                'amount'         => '2131',
                'description'    => 'Building Rent',

            ],
            [
                'expense_head'   => 2,
                'name'           => 'Voluptatem rerum mol',
                'invoice_number' => 'RXA526',
                'date'           => Carbon::parse(Carbon::now())->addDays(1),
                'amount'         => '2135',
                'description'    => 'Equipments',

            ],
            [
                'expense_head'   => 3,
                'name'           => 'Ut nostrud dolore do',
                'invoice_number' => 'QAL951',
                'date'           => Carbon::parse(Carbon::now())->addDays(2),
                'amount'         => '3453',
                'description'    => 'Electricity Bill',

            ],
            [
                'expense_head'   => 4,
                'name'           => 'Quo atque nisi minim',
                'invoice_number' => 'UGI845',
                'date'           => Carbon::parse(Carbon::now())->addDays(3),
                'amount'         => '3543',
                'description'    => 'Telephone Bill',

            ],
            [
                'expense_head'   => 5,
                'name'           => 'A consectetur in co',
                'invoice_number' => 'OUZ891',
                'date'           => Carbon::parse(Carbon::now())->addDays(4),
                'amount'         => '6876',
                'description'    => 'Power Generator Fuel Charge',

            ],
            [
                'expense_head'   => 6,
                'name'           => 'Cumque et labore dol',
                'invoice_number' => 'TUC851',
                'date'           => Carbon::parse(Carbon::now())->addDays(5),
                'amount'         => '8796',
                'description'    => 'Tea Expense',

            ],
            [
                'expense_head'   => 1,
                'name'           => 'Dolorem sed id odit',
                'invoice_number' => 'OGB981',
                'date'           => Carbon::parse(Carbon::now())->addDays(6),
                'amount'         => '9786',
                'description'    => 'Building Rent',

            ],
            [
                'expense_head'   => 2,
                'name'           => 'Ut et nostrum beatae',
                'invoice_number' => 'OGB981',
                'date'           => Carbon::parse(Carbon::now())->addDays(7),
                'amount'         => '3213',
                'description'    => 'Equipments',

            ],
            [
                'expense_head'   => 3,
                'name'           => 'Omnis et vero ipsam ',
                'invoice_number' => 'IYF984',
                'date'           => Carbon::parse(Carbon::now())->addDays(8),
                'amount'         => '3126',
                'description'    => 'Electricity Bill',

            ],
            [
                'expense_head'   => 4,
                'name'           => 'At mollit laboriosam',
                'invoice_number' => 'IYC685',
                'date'           => Carbon::parse(Carbon::now())->addDays(9),
                'amount'         => '3455',
                'description'    => 'Telephone Bill',

            ],
            [
                'expense_head'   => 5,
                'name'           => 'Ratione Nam doloribu',
                'invoice_number' => 'OGB981',
                'date'           => Carbon::parse(Carbon::now())->addDays(10),
                'amount'         => '3546',
                'description'    => 'Power Generator Fuel Charge',

            ],
            [
                'expense_head'   => 6,
                'name'           => 'Minim sit ea eligend',
                'invoice_number' => 'OGB981',
                'date'           => Carbon::parse(Carbon::now())->addDays(2),
                'amount'         => '4563',
                'description'    => 'Tea Expense',

            ],
        ];

        foreach ($input as $data) {
            Expense::create($data);
        }
    }
}
