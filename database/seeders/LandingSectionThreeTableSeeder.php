<?php

namespace Database\Seeders;

use App\Models\SectionThree;
use Illuminate\Database\Seeder;

class LandingSectionThreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'text_main'      => 'Why Hospital SAAS?',
            'text_secondary' => 'We have implemented, Hospital SAAS for our patient\'s registration, appointment scheduling, inpatient management, ICU management, OT management, pharmacy.',
            'img_url'        => ('/assets/landing-theme/images/banner/section_three_sass.png'),
            'text_one'       => 'Fully Secure',
            'text_two'       => 'Easy To Use',
            'text_three'     => 'Regular Updates',
            'text_four'      => '24*7 Support',
        ];

        SectionThree::create($input);
    }
}
