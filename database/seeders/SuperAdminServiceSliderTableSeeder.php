<?php

namespace Database\Seeders;

use App\Models\ServiceSlider;
use Illuminate\Database\Seeder;

class SuperAdminServiceSliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            [
                'image' => asset('/assets/landing-theme/images/banner/treatment.png'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/diagnostics.png'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/emergency.png'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/qualified_doctors.png'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/anasthesia.jpeg'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/injection.png'),
            ],
            [
                'image' => asset('/assets/landing-theme/images/banner/slider_img_seven.png'),
            ],
        ];

        foreach ($inputs as $input) {
            $image = $input['image'];
            unset($input['image']);
            $serviceSlider = ServiceSlider::create($input);
            $serviceSlider->addMediaFromUrl($image)->toMediaCollection(ServiceSlider::SERVICE_SLIDER, config('app.media_disc'));
        }
        
    }
}
