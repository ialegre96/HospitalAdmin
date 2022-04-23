<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class AddHomePageBoxContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        FrontSetting::create([
            'key'       => 'home_page_box_title',
            'value'     => 'Free Consulting',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_box_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);

        // Home Page Step Section
        FrontSetting::create([
            'key'       => 'home_page_step_1_title',
            'value'     => 'Check Doctor Profile',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_step_1_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);

        FrontSetting::create([
            'key'       => 'home_page_step_2_title',
            'value'     => 'Request Consulting',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_step_2_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);

        FrontSetting::create([
            'key'       => 'home_page_step_3_title',
            'value'     => 'Receive Consulting',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_step_3_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);

        FrontSetting::create([
            'key'       => 'home_page_step_4_title',
            'value'     => 'Get Your Solution',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_step_4_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);

        // Home Page Certified Section
        FrontSetting::create([
            'key'       => 'home_page_certified_box_title',
            'value'     => 'Certified Doctor',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'home_page_certified_box_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet.',
            'type'      => FrontSetting::HOME_PAGE,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
