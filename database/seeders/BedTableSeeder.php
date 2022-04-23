<?php

namespace Database\Seeders;

use App\Models\Bed;
use Illuminate\Database\Seeder;

class BedTableSeeder extends Seeder
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
                'bed_type'     => 1,
                'bed_id'       => mb_strtoupper(Bed::generateUniqueBedId()),
                'name'         => 'Bed 1',
                'charge'       => 50,
                'description'  => 'This is the VIP Ward bed',
                'is_available' => 0,
            ],
            [
                'bed_type'     => 2,
                'bed_id'       => mb_strtoupper(Bed::generateUniqueBedId()),
                'name'         => 'Bed 2',
                'charge'       => 100,
                'description'  => 'This is the Private Ward bed',
                'is_available' => 0,
            ],
            [
                'bed_type'     => 3,
                'bed_id'       => mb_strtoupper(Bed::generateUniqueBedId()),
                'name'         => 'Bed 3',
                'charge'       => 100,
                'description'  => 'This is the VIP Ward bed',
                'is_available' => 1,
            ],
        ];

        foreach ($input as $data) {
            Bed::create($data);
        }
    }
}
