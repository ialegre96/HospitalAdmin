<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Medicine;

/**
 * Class MedicineRepository
 * @version February 12, 2020, 11:00 am UTC
 */
class MedicineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'selling_price',
        'buying_price',
        'generic_name',
        'batch_no',
        'effect',
        'betch_no',
        'qty',
        'mfg_date',
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
        return Medicine::class;
    }

    /**
     * @return array
     */
    public function getSyncList()
    {
        $data['categories'] = Category::all()->where('is_active', '=', 1)->pluck('name', 'id')->toArray();
        $data['brands'] = Brand::all()->pluck('name', 'id')->toArray();

        return $data;
    }
}
