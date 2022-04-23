<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Subscription;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use Exception;
use Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class DoctorRepository
 * @version February 13, 2020, 8:55 am UTC
 */
class DoctorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'specialist',
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
        return Doctor::class;
    }

    /**
     * @param  array  $input
     * @param  bool  $mail
     *
     * @return bool
     */
    public function store($input, $mail = true)
    {
        try {
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['department_id'] = Department::whereName('Doctor')->first()->id;
            $input['password'] = Hash::make($input['password']);
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $user = User::create(Arr::except($input, ['specialist', 'doctor_department_id']));
            if ($mail) {
                $user->sendEmailVerificationNotification();
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = storeProfileImage($user, $input['image']);
            }

            $doctor = Doctor::create([
                'user_id'              => $user->id,
                'doctor_department_id' => $input['doctor_department_id'],
                'specialist'           => $input['specialist'],
            ]);
            $ownerId = $doctor->id;
            $ownerType = Doctor::class;

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
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param  array  $doctor
     * @param  array  $input
     *
     * @return bool
     */
    public function update($doctor, $input)
    {
        try {
            unset($input['password']);

            $user = User::find($doctor->user->id);
            if (isset($input['image']) && !empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            /** @var Doctor $doctor */
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (!empty($input['dob'])) ? $input['dob'] : null;
            $doctor->user->update($input);
            $doctor->update($input);

            if (!empty($doctor->address)) {
                if (empty($address = Address::prepareAddressArray($input))) {
                    $doctor->address->delete();
                }
                $doctor->address->update($input);
            } else {
                if (! empty($address = Address::prepareAddressArray($input)) && empty($doctor->address)) {
                    $ownerId = $doctor->id;
                    $ownerType = Doctor::class;
                    Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
                }
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Doctor
     */
    public function getDoctors()
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $doctors;
    }

    /**
     * @param int $doctorId
     *
     * @return mixed
     */
    public function getDoctorAssociatedData($doctorId)
    {
        $data['doctorData'] = Doctor::with([
            'cases.patient.user', 'patients.user', 'schedules', 'payrolls', 'user',
            'address', 'appointments.doctor.user', 'appointments.patient.user', 'appointments.department',
        ])->findOrFail($doctorId);
        $data['appointments'] = $data['doctorData']->appointments;

        return $data;
    }
}
