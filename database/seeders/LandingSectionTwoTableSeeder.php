<?php

namespace Database\Seeders;

use App\Models\SectionTwo;
use Illuminate\Database\Seeder;

class LandingSectionTwoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'text_main'                 => 'Protect Your Health',
            'text_secondary'            => 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services.',
            'card_one_image'            => ('/assets/landing-theme/images/banner/appointment_schedule.png'),
            'card_one_text'             => 'Schedule Appointment',
            'card_one_text_secondary'   => 'Makes it Easy for patients to Book Appointment online from anywhere &amp; anytime.',
            'card_two_image'            => ('/assets/landing-theme/images/banner/ipd_manage.png'),
            'card_two_text'             => 'OPD Management',
            'card_two_text_secondary'   => 'Easily Manage Appointments with one click go to Medical Records of Patient to Save time.IPD Management This module of hospital management system',
            'card_third_image'          => ('/assets/landing-theme/images/banner/opd_manage.png'),
            'card_third_text'           => 'IPD Management',
            'card_third_text_secondary' => 'This module of hospital management system is designed to manage all Inpatient department',
        ];

        SectionTwo::create($input);
    }
}
