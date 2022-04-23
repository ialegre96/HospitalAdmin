<?php

namespace App\Repositories;

use App\Models\ChargeCategory;
use App\Models\RadiologyCategory;
use App\Models\RadiologyTest;

/**
 * Class RadiologyTestRepository
 * @version April 13, 2020, 5:06 am UTC
 */
class RadiologyTestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'testname',
        'shortname',
        'testtype',
        'category_id',
        'subcategory',
        'reportdays',
        'charge_category_id',
        'standard_charge',
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
        return RadiologyTest::class;
    }

    /**
     * @return mixed
     */
    public function getRadiologyAssociatedData()
    {
        $data['radiologyCategories'] = RadiologyCategory::all()->pluck('name', 'id')->sort();
        $data['chargeCategories'] = ChargeCategory::orderBy('name')->pluck('name', 'id');

        return $data;
    }
}
