<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class AddDoctorFrontSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        $imageUrl = asset('web_front/images/healthcare-doctor/doctor-1.png');
        FrontSetting::create([
            'key'       => 'home_page_certified_doctor_image',
            'value'     => $imageUrl,
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_certified_doctor_text',
            'value'     => 'Quality Healthcare',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_certified_doctor_title',
            'value'     => 'Have Certified and High Quality Doctor For You',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_certified_doctor_description',
            'value'     => 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services. Our medical clinic provides quality. Our medical clinic provides quality care for the entire family while maintaining lizam a personable atmosphere best services. Our medical clinic provides.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
