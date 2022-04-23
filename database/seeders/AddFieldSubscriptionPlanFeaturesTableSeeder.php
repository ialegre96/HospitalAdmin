<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AddFieldSubscriptionPlanFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name'      => 'Vaccinations',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'vaccinated-patients.index',
                        'vaccinated-patients.create',
                        'vaccinated-patients.store',
                        'vaccinated-patients.edit',
                        'vaccinated-patients.show',
                        'vaccinated-patients.update',
                        'vaccinated-patients.destroy',
                        'vaccinated-patients.excel',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Vaccination',
                        'route' => [
                            'route_name' => [
                                'vaccinations.index',
                                'vaccinations.create',
                                'vaccinations.store',
                                'vaccinations.edit',
                                'vaccinations.show',
                                'vaccinations.update',
                                'vaccinations.destroy',
                                'vaccinations.excel',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($input as $data) {
            /** @var Feature $feature */
            $feature = Feature::where('name', $data['name'])->first();
            if ($feature) {
                $feature->update(Arr::only($data, ['name', 'submenu', 'route']));
                if (isset($data['sub_menus'])) {
                    foreach ($data['sub_menus'] as $subMenu) {
                        $subMenuFeature = Feature::where('name', $subMenu['name'])->first();
                        if ($subMenuFeature) {
                            $subMenu['has_parent'] = $feature->id;
                            $subMenuFeature->update($subMenu);
                        } else {
                            $subMenu['has_parent'] = $feature->id;
                            Feature::create($subMenu);
                        }
                    }
                }
            } else {
                $feature = Feature::create(Arr::only($data, ['name', 'submenu', 'route', 'is_default']));
                if (isset($data['sub_menus'])) {
                    foreach ($data['sub_menus'] as $subMenu) {
                        $subMenu['has_parent'] = $feature->id;
                        Feature::create($subMenu);
                    }
                }
            }
        }
    }
}
