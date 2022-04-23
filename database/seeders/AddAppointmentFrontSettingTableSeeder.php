<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class AddAppointmentFrontSettingTableSeeder extends Seeder
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
            'key'       => 'appointment_title',
            'value'     => 'Contact Now and Get the Best Doctor Service Today',
            'type'      => FrontSetting::APPOINTMENT,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
        FrontSetting::create([
            'key'       => 'appointment_description',
            'value'     => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis.',
            'type'      => FrontSetting::APPOINTMENT,
            'tenant_id' => $userTenantId != null ? $userTenantId : null,
        ]);
    }
}
