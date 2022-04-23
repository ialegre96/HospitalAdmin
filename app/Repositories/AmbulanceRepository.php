<?php

namespace App\Repositories;

use App\Models\Ambulance;
use App\Models\CaseHandler;
use App\Models\Notification;
use App\Models\Receptionist;
use App\Models\User;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AmbulanceRepository
 * @version March 26, 2020, 5:23 am UTC
 */
class AmbulanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehicle_number',
        'vehicle_model',
        'year_made',
        'driver_name',
        'driver_license',
        'driver_contact',
        'note',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ambulance::class;
    }

    /**
     * @return Ambulance
     */
    public function getAmbulances()
    {
        /** @var Ambulance $ambulances */
        $ambulances = Ambulance::whereIsAvailable(1)->pluck('vehicle_model', 'id')->sort();

        return $ambulances;
    }

    /**
     * @return bool
     */
    public function createNotification()
    {
        try {
            $ownerType = [Receptionist::class, CaseHandler::class];
            $userIds = User::whereIn('owner_type', $ownerType)->pluck('owner_type', 'id')->toArray();
            $adminUser = User::role('Admin')->first();
            $allUsers = $userIds + [$adminUser->id => Notification::NOTIFICATION_FOR[Notification::ADMIN]];
            $users = getAllNotificationUser($allUsers);

            foreach ($users as $id => $ownerType) {
                addNotification([
                    Notification::NOTIFICATION_TYPE['Ambulance'],
                    $id,
                    Notification::NOTIFICATION_FOR[User::getOwnerType($ownerType)],
                    'New ambulance has been added.',
                ]);
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
