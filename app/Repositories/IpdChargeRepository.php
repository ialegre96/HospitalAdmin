<?php

namespace App\Repositories;

use App\Models\Charge;
use App\Models\ChargeCategory;
use App\Models\IpdCharge;
use App\Models\IpdPatientDepartment;
use App\Models\Notification;
use App\Models\Receptionist;
use Exception;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class IpdChargeRepository
 * @version September 9, 2020, 1:55 pm UTC
 */
class IpdChargeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipd_patient_department_id',
        'date',
        'charge_type_id',
        'charge_category_id',
        'charge_id',
        'standard_charge',
        'applied_charge',
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
        return IpdCharge::class;
    }

    /**
     * @param  int  $chargeTypeId
     *
     * @return Collection
     */
    public function getChargeCategories($chargeTypeId)
    {
        return ChargeCategory::where('charge_type', $chargeTypeId)->pluck('name', 'id');
    }

    /**
     * @param  int  $chargeCategoryId
     *
     * @return Collection
     */
    public function getCharges($chargeCategoryId)
    {
        return Charge::where('charge_category_id', $chargeCategoryId)->pluck('code', 'id');
    }

    /**
     * @param  int  $chargeId
     * @param  bool  $isEdit
     * @param  array  $onceOnEditRender
     * @param  int  $ipdChargeId
     *
     * @return Collection
     */
    public function getChargeStandardRate($chargeId, $isEdit, $onceOnEditRender, $ipdChargeId)
    {
        $charge = null;
        if (! $isEdit) {
            $charge = Charge::where('id', $chargeId)->value('standard_charge');
        } else {
            if ($onceOnEditRender != null) {
                $charge = IpdCharge::where('id', $ipdChargeId)->first();
            } else {
                $charge = Charge::where('id', $chargeId)->first();
                if ($charge != null) {
                    $charge->setAttribute('applied_charge', $charge->standard_charge);
                }
            }
        }

        return $charge;
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = IpdPatientDepartment::with('patient.user')->where('id',
                $input['ipd_patient_department_id'])->first();
            $receptionists = Receptionist::pluck('user_id', 'id')->toArray();
            $userIds = [
                $patient->patient->user_id => Notification::NOTIFICATION_FOR[Notification::PATIENT],
            ];

            foreach ($receptionists as $key => $userId) {
                $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::RECEPTIONIST];
            }
            $users = getAllNotificationUser($userIds);

            foreach ($users as $key => $notification) {
                if ($notification == Notification::NOTIFICATION_FOR[Notification::PATIENT]) {
                    $title = $patient->patient->user->full_name.' your IPD charge has been created.';
                } else {
                    $title = $patient->patient->user->full_name.' IPD charge has been created.';
                }
                addNotification([
                    Notification::NOTIFICATION_TYPE['IPD Charge'],
                    $key,
                    $notification,
                    $title,
                ]);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
