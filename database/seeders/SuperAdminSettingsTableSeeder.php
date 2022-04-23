<?php

namespace Database\Seeders;

use App\Models\SuperAdminSetting;
use Illuminate\Database\Seeder;

class SuperAdminSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = asset('web/img/hms-saas-logo.png');
        $favicon = asset('web/img/hms-saas-favicon.ico');

        SuperAdminSetting::create(['key' => 'app_name', 'value' => 'InfyHMS']);
        SuperAdminSetting::create(['key' => 'app_logo', 'value' => $imageUrl]);
        SuperAdminSetting::create(['key' => 'favicon', 'value' => $favicon]);
    }
}
