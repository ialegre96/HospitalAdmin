<?php

namespace App\Repositories;

use App\Models\BloodDonation;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class BloodDonationRepository
 */
class BloodDonationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'blood_donor_id',
        'donation_date',
        'bags',
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
        return BloodDonation::class;
    }

    /** @param  array  $input */
    public function createBloodDonation($input)
    {
        try {
            /** @var BloodDonation $bloodDonation */
            $bloodDonation = $this->create($input);

            /** @var BloodDonation $bloodDonation */
            $bloodDonation = BloodDonation::with('bloodDonor.bloodBank')->find($bloodDonation->id);
            $bloodBank = $bloodDonation->bloodDonor->bloodBank;
            $remainedBags = $bloodBank->remained_bags + $input['bags'];
            $bloodBank->update(['remained_bags' => $remainedBags]);

            $bloodDonation->bloodDonor->update(['last_donate_date' => $bloodDonation->created_at]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  BloodDonation  $bloodDonation
     */
    public function updateBloodDonation($input, $bloodDonation)
    {
        try {
            /** @var BloodDonation $bloodDonation */
            $bloodDonation = BloodDonation::with('bloodDonor.bloodBank')->find($bloodDonation->id);
            $currentBags = $bloodDonation->bags;

            /** @var BloodDonation $bloodDonation */
            $bloodDonation = $this->update($input, $bloodDonation->id);

            $bloodBank = $bloodDonation->bloodDonor->bloodBank;
            $remainedBags = ($bloodBank->remained_bags - $currentBags) + $input['bags'];

            $bloodBank->update(['remained_bags' => $remainedBags]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
