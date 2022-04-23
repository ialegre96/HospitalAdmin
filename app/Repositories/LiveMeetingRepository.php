<?php

namespace App\Repositories;

use App;
use App\Models\LiveMeeting;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class LiveMeetingRepository
 */
class LiveMeetingRepository extends BaseRepository
{
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'description',
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
        return LiveMeeting::class;
    }

    /**
     * @param  array  $input
     *
     * @throws BindingResolutionException
     *
     * @return bool
     */
    public function store($input)
    {
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::makeWith(ZoomRepository::class, ['createdBy' => getLoggedInUserId()]);

        try {
            $input['created_by'] = getLoggedInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');
            $zoom = $zoomRepo->create($input);
            $input['password'] = isset($zoom['data']['password']) ? $zoom['data']['password'] : \Str::random(6);
            $input['meeting_id'] = $zoom['data']['id'];
            $input['meta'] = $zoom['data'];

            $zoomModel = LiveMeeting::create($input);
            $zoomModel->members()->attach($input['staff_list']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param  LiveMeeting  $liveMeeting
     *
     * @return bool
     */
    public function edit($input, $liveMeeting)
    {
        try {
            /** @var ZoomRepository $zoomRepo */
            $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveMeeting->created_by]);

            $zoomRepo->update($liveMeeting->meeting_id, $input);
            $zoom = $zoomRepo->get($liveMeeting->meeting_id, ['meeting_owner' => $liveMeeting->created_by]);
            $input['password'] = isset($zoom['data']['password']) ? $zoom['data']['password'] : \Str::random(6);
            $input['meta'] = $zoom['data'];
            $input['created_by'] = $liveMeeting->created_by != getLoggedInUserId() ? $liveMeeting->created_by : getLoggedInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');

            $liveMeeting->update($input);
            $liveMeeting->members()->sync($input['staff_list']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        try {
            $roles = User::orderBy('first_name')->whereHas('roles', function (Builder $query) {
                $query->where('name', '!=', 'Patient');
            })->where('status', '=', 1)->get();
            $result = [];
            foreach ($roles as $role) {
                foreach ($role->roles as $roleName) {
                    $result[$role->id] = $role->full_name.' ('.$roleName->name.')';
                }
            }

            return $result;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input = [])
    {
        try {
            $id = $input['staff_list'];
            $users = [];
            foreach ($id as $key => $value) {
                $users[$value] = User::where('id', $value)->pluck('owner_type', 'id')->first();
            }

            foreach ($users as $key => $userId) {
                $userIds[$key] = Notification::NOTIFICATION_FOR[User::getOwnerType($userId)];
            }

            unset($userIds[getLoggedInUserId()]);

            foreach ($userIds as $key => $notification) {
                addNotification([
                    Notification::NOTIFICATION_TYPE['Live Meeting'],
                    $key,
                    $notification,
                    getLoggedInUser()->first_name.' '.getLoggedInUser()->last_name.' has been created a live meeting.',
                ]);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
