<?php

namespace App\Repositories;

use App\Models\NoticeBoard;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class NoticeBoardRepository
 * @version February 18, 2020, 4:23 am UTC
 */
class NoticeBoardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'start_date',
        'end_date',
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
        return NoticeBoard::class;
    }

    /**
     * @return bool
     */
    public function createNotification()
    {
        try {
            $users = User::where('email', '!=', 'admin@hms.com')
                ->pluck('owner_type', 'id')
                ->toArray();

            foreach ($users as $key => $ownerType) {
                $userIds[$key] = Notification::NOTIFICATION_FOR[User::getOwnerType($ownerType)];
            }

            foreach ($userIds as $key => $notification) {
                addNotification([
                    Notification::NOTIFICATION_TYPE['NoticeBoard'],
                    $key,
                    $notification,
                    'New notice board added.',
                ]);
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
