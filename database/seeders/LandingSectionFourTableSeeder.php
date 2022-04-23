<?php

namespace Database\Seeders;

use App\Models\SectionFour;
use Illuminate\Database\Seeder;

class LandingSectionFourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'text_main'                 => 'Grow Your Hospital',
            'text_secondary'            => 'We Help To Grow Your Hospital Beyond Your Expectation',
            'img_url_one'               => ('/assets/landing-theme/images/banner/bulit_seo.png'),
            'img_url_two'               => ('/assets/landing-theme/images/banner/hospital_profile.png'),
            'img_url_three'             => ('/assets/landing-theme/images/banner/online_appointment.png'),
            'img_url_four'              => ('/assets/landing-theme/images/banner/articles.png'),
            'img_url_five'              => ('/assets/landing-theme/images/banner/easy_to_use.png'),
            'img_url_six'               => ('/assets/landing-theme/images/banner/support.jpeg'),
            'card_text_one'             => 'Built SEO',
            'card_text_two'             => 'Hospital Profile',
            'card_text_three'           => 'Online Appointment',
            'card_text_four'            => 'Articles',
            'card_text_five'            => 'Easy to Use',
            'card_text_six'             => '24*7 Support',
            'card_text_one_secondary'   => 'SEO Brings Higher patient retention Rates which will Results into Higher Conversion Rate.',
            'card_text_two_secondary'   => 'More than 80% of people searching for medical professionals make their selection from HMS.',
            'card_text_three_secondary' => 'Provide comfort to your patients in this pandemic situation to book online appointments.',
            'card_text_four_secondary'  => 'Keep updated with latest techniques/knowledge/research to build a professional network.',
            'card_text_five_secondary'  => 'Top quality Software with all Features easy to use and easily accessible.',
            'card_text_six_secondary'   => 'Any time we are here to help you.',
        ];

        SectionFour::create($input);
    }
}
