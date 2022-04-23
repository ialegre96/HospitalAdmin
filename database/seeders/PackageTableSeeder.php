<?php

namespace Database\Seeders;

use App\Repositories\PackageRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class PackageTableSeeder extends Seeder
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
                'name'         => 'Package 1',
                'discount'     => 10,
                'total_amount' => 70,
                'service_id'   => [
                    0 => 1,
                    1 => 2,
                ],
                'quantity'     => [
                    0 => 2,
                    1 => 3,
                ],
                'rate'         => [
                    0 => 10,
                    1 => 20,
                ],
            ],
            [
                'name'         => 'Package 2',
                'discount'     => 20,
                'total_amount' => 1140,
                'service_id'   => [
                    0 => 1,
                    1 => 2,
                ],
                'quantity'     => [
                    0 => 5,
                    1 => 6,
                ],
                'rate'         => [
                    0 => 100,
                    1 => 110,
                ],
            ],
        ];

        foreach ($input as $key => $value) {
            /** @var PackageRepository $package */
            $package = App::make(PackageRepository::class);
            $package->store($input[$key]);
        }
    }
}
