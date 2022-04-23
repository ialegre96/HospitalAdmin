<?php

namespace App\Repositories;

use App\Models\BloodDonor;
use App\Models\BloodIssue;
use Illuminate\Support\Collection;

/**
 * Class BloodIssueRepository
 */
class BloodIssueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'issue_date',
        'doctor_id',
        'donor_id',
        'patient_id',
        'amount',
        'remarks',
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
        return BloodIssue::class;
    }

    /**
     * @param  int  $id
     *
     * @return Collection
     */
    public function getBloodGroup($id)
    {
        return BloodDonor::where('id', $id)->pluck('blood_group', 'id');
    }
}
