<?php

namespace Database\Seeders;

use App\Models\SectionOne;
use Illuminate\Database\Seeder;

class LandingSectionOneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'text_main'      => 'Manage Hospital Never Before',
            'text_secondary' => 'A Next Level Evolution In Healthcare IT, Web Based EMR, Revenue Cycle Management Solution, Designed To Meet The Opportunities.',
            'img_url'        => ('/assets/landing-theme/images/banner/section_one.png'),
        ];

        SectionOne::create($input);
    }
}
