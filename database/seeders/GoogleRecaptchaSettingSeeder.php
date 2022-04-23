<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class GoogleRecaptchaSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);

        Setting::create([
            'key'       => 'enable_google_recaptcha', 'value' => 0,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
