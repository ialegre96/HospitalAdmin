<?php

namespace App\Repositories;

use App\Models\ChargeCategory;
use App\Models\PathologyCategory;
use App\Models\PathologyTest;

/**
 * Class PathologyTestRepository
 * @version April 14, 2020, 9:33 am UTC
 */
class PathologyTestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'test_name',
        'short_name',
        'test_type',
        'category_id',
        'unit',
        'subcategory',
        'method',
        'report_days',
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
        return PathologyTest::class;
    }

    /**
     * @return mixed
     */
    public function getPathologyAssociatedData()
    {
        $data['pathologyCategories'] = PathologyCategory::all()->pluck('name', 'id');
        $data['chargeCategories'] = ChargeCategory::all()->pluck('name', 'id');

        return $data;
    }
}
