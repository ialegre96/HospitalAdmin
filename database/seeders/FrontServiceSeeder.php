<?php

namespace Database\Seeders;

use App\Models\FrontService;
use Illuminate\Database\Seeder;

class FrontServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenantId = session('tenant_id', null);
        $service1 = FrontService::create([
            'name'              => 'Cardiology',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service1->addMediaFromUrl(asset('web_front/images/services/cardiology.png'))->toMediaCollection(FrontService::PATH);
        $service2 = FrontService::create([
            'name'              => 'Orthopedics',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service2->addMediaFromUrl(asset('web_front/images/services/orthopedics.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service3 = FrontService::create([
            'name'              => 'Pulmonology',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service3->addMediaFromUrl(asset('web_front/images/services/pulmonology.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service4 = FrontService::create([
            'name'              => 'Dental Care',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service4->addMediaFromUrl(asset('web_front/images/services/dental-care.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service5 = FrontService::create([
            'name'              => 'Medicine',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service5->addMediaFromUrl(asset('web_front/images/services/medicine.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service6 = FrontService::create([
            'name'              => 'Ambulance',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service6->addMediaFromUrl(asset('web_front/images/services/ambulance.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service7 = FrontService::create([
            'name'              => 'Ophthalmology',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service7->addMediaFromUrl(asset('web_front/images/services/ophthalmology.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );

        $service8 = FrontService::create([
            'name'              => 'Neurology',
            'short_description' => 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.',
            'tenant_id'         => $userTenantId != null ? $userTenantId : null,
        ]);
        $service8->addMediaFromUrl(asset('web_front/images/services/neurology.png'))->toMediaCollection(
            FrontService::PATH,
            config('app.media_disc')
        );
    }
}
