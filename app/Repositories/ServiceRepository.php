<?php

namespace App\Repositories;

use App\Models\Accountant;
use App\Models\Notification;
use App\Models\Receptionist;
use App\Models\Service;
use App\Models\User;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServiceRepository
 * @version February 25, 2020, 10:50 am UTC
 */
class ServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'quantity',
        'rate',
        'status',
    ];

    /**
     * Return searchable fields
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
        return Service::class;
    }

    /**
     * @return bool
     */
    public function createNotification()
    {
        try {
            $ownerType = [Receptionist::class, Accountant::class];
            $userIds = User::whereIn('owner_type', $ownerType)->pluck('owner_type', 'id')->toArray();
            $adminUser = User::role('Admin')->first();
            $allUsers = $userIds + [$adminUser->id => ''];
            $users = getAllNotificationUser($allUsers);

            foreach ($users as $id => $ownerType) {
                addNotification([
                    Notification::NOTIFICATION_TYPE['Service'],
                    $id,
                    Notification::NOTIFICATION_FOR[User::getOwnerType($ownerType)],
                    'New service has been added.',
                ]);
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
