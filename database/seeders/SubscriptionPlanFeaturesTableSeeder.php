<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SubscriptionPlanFeaturesTableSeeder extends Seeder
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
                'name'      => 'Appointments',
                'route'     => [
                    'route_name' => [
                        'appointments.index',
                        'appointments.create',
                        'appointments.store',
                        'doctors.list',
                        'doctor-schedule-list',
                        'get.booking.slot',
                        'patient.appointment.update',
                        'appointments.show',
                        'appointments.destroy',
                        'appointments.excel',
                        'appointment.status',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Appointment Calendar',
                        'route' => [
                            'route_name' => [
                                'appointment-calendars.index',
                                'calendar-list',
                                'appointment.details',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Blood Banks',
                'submenu'   => 4,
                'route'     => [
                    'route_name' => [
                        'blood-banks.index',
                        'blood-banks.create',
                        'blood-banks.store',
                        'blood-banks.edit',
                        'blood-banks.update',
                        'blood-banks.destroy',
                        'blood.banks.excel',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Blood Donors',
                        'route' => [
                            'route_name' => [
                                'blood-donors.index',
                                'blood-donors.create',
                                'blood-donors.store',
                                'blood-donors.edit',
                                'blood-donors.update',
                                'blood-donors.destroy',
                                'blood.donors.excel',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Blood Donations',
                        'route' => [
                            'route_name' => [
                                'blood-donations.index',
                                'blood-donations.create',
                                'blood-donations.store',
                                'blood-donations.edit',
                                'blood-donations.update',
                                'blood-donations.destroy',
                                'blood.donations.excel',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Blood Issues',
                        'route' => [
                            'route_name' => [
                                'blood-issues.index',
                                'blood-issues.create',
                                'blood-issues.store',
                                'blood-issues.edit',
                                'blood-issues.update',
                                'blood-issues.destroy',
                                'blood-issues.list',
                                'blood.issues.excel',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Documents',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'documents.index',
                        'documents.create',
                        'documents.store',
                        'documents.edit',
                        'documents.update',
                        'documents.destroy',
                        'document.download',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Document Types',
                        'route' => [
                            'route_name' => [
                                'document-types.index',
                                'document-types.create',
                                'document-types.store',
                                'document-types.edit',
                                'document-types.show',
                                'document-types.update',
                                'document-types.destroy',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Live Consultations',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'live.consultation.index',
                        'live.consultation.create',
                        'live.consultation.store',
                        'live.consultation.edit',
                        'live.consultation.show',
                        'live.consultation.update',
                        'live.consultation.destroy',
                        'live.consultation.list',
                        'live.consultation.change.status',
                        'live.consultation.get.live.status',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Live Meetings',
                        'route' => [
                            'route_name' => [
                                'live.meeting.index',
                                'live.meeting.store',
                                'live.meeting.change.status',
                                'live.meeting.get.live.status',
                                'live.meeting.show',
                                'live.meeting.edit',
                                'live.meeting.update',
                                'live.meeting.destroy',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Inventory',
                'submenu'   => 4,
                'route'     => [
                    'route_name' => [
                        'item-categories.index',
                        'item-categories.store',
                        'item-categories.edit',
                        'item-categories.update',
                        'item-categories.destroy',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Items',
                        'route' => [
                            'route_name' => [
                                'items.index',
                                'items.create',
                                'items.store',
                                'items.edit',
                                'items.show',
                                'items.update',
                                'items.destroy',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Item Stocks',
                        'route' => [
                            'route_name' => [
                                'item.stock.index',
                                'item.stock.create',
                                'item.stock.store',
                                'item.stock.edit',
                                'item.stock.show',
                                'item.stock.update',
                                'item.stock.destroy',
                                'item.stock.download',
                                'items.list',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Issued Items',
                        'route' => [
                            'route_name' => [
                                'issued.item.index',
                                'issued.item.create',
                                'users.list',
                                'item.available.qty',
                                'return.issued.item',
                                'issued.item.store',
                                'issued.item.show',
                                'issued.item.destroy',
                            ],
                        ],
                    ],
                ],
            ],
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
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'SMS / Mail',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'sms.index',
                        'sms.store',
                        'sms.show',
                        'sms.show.modal',
                        'sms.destroy',
                        'sms.users.lists',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Mail',
                        'route' => [
                            'route_name' => [
                                'mail',
                                'mail.send',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Radiology',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'radiology.category.index',
                        'radiology.category.create',
                        'radiology.category.store',
                        'radiology.category.edit',
                        'radiology.category.update',
                        'radiology.category.destroy',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Radiology Tests',
                        'route' => [
                            'route_name' => [
                                'radiology.test.index',
                                'radiology.test.create',
                                'radiology.test.store',
                                'radiology.test.edit',
                                'radiology.test.show',
                                'radiology.test.show.modal',
                                'radiology.test.update',
                                'radiology.test.destroy',
                                'radiology.test.standard.charge',
                                'radiology.tests.excel',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Reports',
                'submenu'   => 4,
                'route'     => [
                    'route_name' => [
                        'birth-reports.index',
                        'birth-reports.create',
                        'birth-reports.store',
                        'birth-reports.edit',
                        'birth-reports.show',
                        'birth-reports.update',
                        'birth-reports.destroy',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Death Reports',
                        'route' => [
                            'route_name' => [
                                'death-reports.index',
                                'death-reports.create',
                                'death-reports.store',
                                'death-reports.edit',
                                'death-reports.show',
                                'death-reports.update',
                                'death-reports.destroy',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Investigation Reports',
                        'route' => [
                            'route_name' => [
                                'investigation-reports.index',
                                'investigation-reports.create',
                                'investigation-reports.store',
                                'investigation-reports.edit',
                                'investigation-reports.show',
                                'investigation-reports.update',
                                'investigation-reports.destroy',
                                'investigation.reports.download',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'Operation Reports',
                        'route' => [
                            'route_name' => [
                                'operation-reports.index',
                                'operation-reports.create',
                                'operation-reports.store',
                                'operation-reports.edit',
                                'operation-reports.show',
                                'operation-reports.update',
                                'operation-reports.destroy',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'      => 'Pathology',
                'submenu'   => 2,
                'route'     => [
                    'route_name' => [
                        'pathology.category.index',
                        'pathology.category.create',
                        'pathology.category.store',
                        'pathology.category.edit',
                        'pathology.category.show',
                        'pathology.category.update',
                        'pathology.category.destroy',
                    ],
                ],
                'sub_menus' => [
                    [
                        'name'  => 'Pathology Tests',
                        'route' => [
                            'route_name' => [
                                'pathology.test.index',
                                'pathology.test.create',
                                'pathology.test.store',
                                'pathology.test.edit',
                                'pathology.test.show',
                                'pathology.test.show.modal',
                                'pathology.test.update',
                                'pathology.test.destroy',
                                'pathology.test.standard.charge',
                                'pathology.tests.excel',
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
