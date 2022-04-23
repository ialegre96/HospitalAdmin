<?php

namespace Database\Seeders;

use App\Models\LandingAboutUs;
use Illuminate\Database\Seeder;

class LandingAboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'text_main'                 => 'How It Work',
            'card_img_one'              => ('/assets/landing-theme/images/banner/about_us.png'),
            'card_img_two'              => ('/assets/landing-theme/images/banner/check-circle-regular.svg'),
            'card_img_three'            => ('/assets/landing-theme/images/banner/credit-card-solid.svg'),
            'main_img_one'              => ('/assets/landing-theme/images/about/12.svg'),
            'main_img_two'              => ('/assets/landing-theme/images/about/14.svg'),
            'card_one_text'             => 'Research',
            'card_two_text'             => 'HMS Customization',
            'card_three_text'           => 'Cost Effective',
            'card_one_text_secondary'   => 'HMS specialises in developing innovative, efficient and smart healthcare solutions.',
            'card_two_text_secondary'   => 'We offer complete HMS customization solutions. We are staffed by eLearning experts and we know how to get the most from HMS.',
            'card_three_text_secondary' => 'HMS not only saves time in the hospital but also is cost-effective in decreasing the number of people working on the Paper work.',
        ];

        LandingAboutUs::create($input);
    }
}
