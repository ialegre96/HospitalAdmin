<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

/**
 * Class FrontSettingTableSeeder
 */
class FrontSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        $imageUrl = asset('assets/img/default_image.jpg');
        FrontSetting::create([
            'key'       => 'about_us_title',
            'value'     => 'About For HMS',
            'type'      => FrontSetting::ABOUT_US,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'about_us_description',
            'value'     => 'HMS will teach physicians and nurses from around the world the principles of blood management, as well as how to manage their own blood conservation programs. The hospital was chosen based on the reputation its bloodless program has established in the medical community and because of its nationally recognized results.

We are a group of creative nerds making awesome stuff for Web and Mobile. We just love to contribute to open source technologies. We always try to build something which helps developers to save their time. so they can spend a bit more time with their friends And family.',
            'type'      => FrontSetting::ABOUT_US,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'about_us_mission',
            'value'     => 'We are providing advanced emergency services. We have well-equipped emergency and trauma center with facilities.',
            'type'      => FrontSetting::ABOUT_US,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'about_us_image',
            'value'     => $imageUrl,
            'type'      => FrontSetting::ABOUT_US,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
