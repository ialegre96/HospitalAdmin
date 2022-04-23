<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class InvoiceTableSeeder extends Seeder
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
                'patient_id'   => 1,
                'invoice_date' => Carbon::now(),
                'invoice_id'   => Invoice::generateUniqueInvoiceId(),
                'amount'       => 72,
                'discount'     => 10,
                'status'       => 1,
                'account_id'   => [
                    0 => 1,
                    1 => 2,
                ],
                'description'  => [
                    0 => 'item description',
                    1 => 'item description',
                ],
                'quantity'     => [
                    0 => 2,
                    1 => 3,
                ],
                'price'        => [
                    0 => 10,
                    1 => 20,
                ],
            ],
            [
                'patient_id'   => 2,
                'invoice_date' => Carbon::now(),
                'invoice_id'   => Invoice::generateUniqueInvoiceId(),
                'amount'       => 124,
                'discount'     => 11,
                'status'       => 1,
                'account_id'   => [
                    0 => 1,
                    1 => 2,
                ],
                'description'  => [
                    0 => 'item description',
                    1 => 'item description',
                ],
                'quantity'     => [
                    0 => 4,
                    1 => 5,
                ],
                'price'        => [
                    0 => 10,
                    1 => 20,
                ],
            ],
        ];

        foreach ($input as $key => $value) {
            /** @var InvoiceRepository $invoice */
            $invoice = App::make(InvoiceRepository::class);
            $invoice->saveInvoice($input[$key]);
        }
    }
}
