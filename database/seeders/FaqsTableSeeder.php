<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
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
                'question' => 'Is My Electronic Health Record Kept Private?',
                'answer'   => 'Health records are kept totally private and we employ robust encryption methods to protect your personal information. You determine who can see the information in your record.',
            ],
            [
                'question' => 'Can Doctor 24x7 Handle My Emergency Situations?',
                'answer'   => 'Doctor 24×7 is designed to handle non-emergent medical problems. You should NOT use it if you are experiencing a medical emergency.',
            ],
            [
                'question' => 'Can I Call Doctor 24x7 Outside Of India?',
                'answer'   => 'Doctor 24×7 consults are unavailable outside of India. However, if you are travelling outside India, you can use our service from a mobile phone using a SIM card issued in India.',
            ],
            [
                'question' => 'Is my electronic health record kept private?',
                'answer'   => 'Health records are kept totally private and we employ robust encryption methods to protect your personal information. You determine who can see the information in your record.',
            ],
            [
                'question' => 'How much does a consult cost?',
                'answer'   => 'The cost of a Doctor consult varies, depending on your choice of consulting the 1st available Doctor OR requesting a call back from a specific Doctor.',
            ],
            [
                'question' => 'Do I Talk to "real doctors"?',
                'answer'   => 'Yes. Doctor 24×7 subscribers only talk to reputed Doctors/Experts attached with top hospitals/private practice who are Licensed practitioners. Each Doctor/Expert on our network is qualified.',
            ],
        ];

        foreach ($input as $faqs) {
            Faqs::create($faqs);
        }
    }
}
