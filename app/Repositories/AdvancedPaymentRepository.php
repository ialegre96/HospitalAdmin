<?php

namespace App\Repositories;

use App\Models\AdvancedPayment;
use App\Models\Notification;
use App\Models\Patient;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AdvancedPaymentRepository
 * @version March 2, 2020, 4:38 am UTC
 */
class AdvancedPaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'receipt_no',
        'amount',
        'date',
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
        return AdvancedPayment::class;
    }

    /**
     * @return Patient
     */
    public function getPatients()
    {
        /** @var Patient $patients */
        $patients = Patient::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $patients;
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = AdvancedPayment::with('patient.user')->where('patient_id', $input['patient_id'])->first();

            addNotification([
                Notification::NOTIFICATION_TYPE['Advance Payment'],
                $patient->patient->user_id,
                Notification::NOTIFICATION_FOR[Notification::PATIENT],
                $patient->patient->user->full_name.' your advance payment receive successfully.',
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
