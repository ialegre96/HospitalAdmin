<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        $imageUrl = asset('web/img/hms-saas-logo.png');

        Setting::create(['key'       => 'app_name', 'value' => 'HMS',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'app_logo', 'value' => $imageUrl,
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'company_name', 'value' => 'InfyOmLabs',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'current_currency', 'value' => 'inr',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'hospital_address', 'value' => '16/A saint Joseph Park',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'hospital_email', 'value' => 'cityhospital@gmail.com',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'hospital_phone', 'value' => '+919876543210',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'hospital_from_day', 'value' => 'Mon to Fri',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        Setting::create(['key'       => 'hospital_from_time', 'value' => '9 AM to 9 PM',
                         'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
