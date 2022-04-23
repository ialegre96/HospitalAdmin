<?php

namespace Database\Seeders;

use App\Models\AdminTestimonial;
use Illuminate\Database\Seeder;

class AdminTestimonialSeeder extends Seeder
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
                'name'        => 'Jasse Lynn',
                'description' => 'Eeque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi tempora incidunt contact
                                            me.',
                'position'    => 'Founder of Sassaht',
            ],
            [
                'name'        => 'Thomas James',
                'description' => 'Reasonable porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt
                                            looks.',
                'position'    => 'CEO of Sassaht',
            ],
            [
                'name'        => 'Ceathy White',
                'description' => 'On the other hand, we denounce with righteous indignation and dislike men who
                                            are so beguiled and demoralized by the charms of pleasure of the momen
                                            words.',
                'position'    => 'Founder of Sassaht',
            ],
        ];

        foreach ($input as $testimonial) {
            AdminTestimonial::create($testimonial);
        }
    }
}
