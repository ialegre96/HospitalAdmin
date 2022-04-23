<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Department;
use App\Models\Nurse;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class NurseRepository
 * @version February 13, 2020, 11:18 am UTC
 */
class NurseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'email',
        'phone',
        'education',
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
        return Nurse::class;
    }

    /**
     * @param  array  $input
     *
     * @param  bool  $mail
     * @return bool
     */
    public function store($input, $mail = true)
    {
        try {
            $input['department_id'] = Department::whereName('Nurse')->first()->id;
            $input['password'] = Hash::make($input['password']);
            /** @var User $user */
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $user = User::create($input);
            if ($mail) {
                $user->sendEmailVerificationNotification();
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = storeProfileImage($user, $input['image']);
            }
            $nurse = Nurse::create(['user_id' => $user->id]);
            $ownerId = $nurse->id;
            $ownerType = Nurse::class;

            /*
            $subscription = [
                'user_id'    => $user->id,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addDays(6),
                'status'     => 1,
            ];
            Subscription::create($subscription);
            */

            if (! empty($address = Address::prepareAddressArray($input))) {
                Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
            }

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($input['department_id']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  Nurse  $nurse
     * @param  array  $input
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($nurse, $input)
    {
        try {
            unset($input['password']);

            /** @var User $user */
            $user = User::find($nurse->user->id);
            if (isset($input['image']) && !empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            /** @var Nurse $nurse */
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (!empty($input['dob'])) ? $input['dob'] : null;
            $nurse->user->update($input);
            $nurse->update($input);

            if (!empty($nurse->address)) {
                if (empty($address = Address::prepareAddressArray($input))) {
                    $nurse->address->delete();
                }
                $nurse->address->update($input);
            } else {
                if (! empty($address = Address::prepareAddressArray($input)) && empty($nurse->address)) {
                    $ownerId = $nurse->id;
                    $ownerType = Nurse::class;
                    Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
                }
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
