<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
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
                'name'     => 'service 1',
                'quantity' => 2,
                'rate'     => 10,
                'status'   => 1,
            ],
            [
                'name'     => 'service 2',
                'quantity' => 3,
                'rate'     => 20,
                'status'   => 0,
            ],
        ];

        foreach ($input as $data) {
            Service::create($data);
        }
    }
}
