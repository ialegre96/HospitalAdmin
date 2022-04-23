<?php

namespace Database\Seeders;

use App\Models\SuperAdminSetting;
use Illuminate\Database\Seeder;

class AddDaysIntoSuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdminSetting::create(['key' => 'plan_expire_notification', 'value' => '6']);
    }
}
