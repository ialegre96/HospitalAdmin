<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class RadiologyTest
 *
 * @version April 13, 2020, 5:06 am UTC
 * @property string test_name
 * @property string short_name
 * @property string test_type
 * @property int category_id
 * @property string subcategory
 * @property int report_days
 * @property int charge_category_id
 * @property int standard_charge
 * @property int $id
 * @property string $test_name
 * @property string $short_name
 * @property string $test_type
 * @property int $category_id
 * @property string|null $subcategory
 * @property int|null $report_days
 * @property int $charge_category_id
 * @property int $standard_charge
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ChargeCategory $chargecategory
 * @property-read \App\Models\RadiologyCategory $radiologycategory
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereChargeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereReportDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereStandardCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereSubcategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereTestName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereTestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyTest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RadiologyTest extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'radiology_tests';

    public $fillable = [
        'test_name',
        'short_name',
        'test_type',
        'category_id',
        'subcategory',
        'report_days',
        'charge_category_id',
        'standard_charge',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'test_name'          => 'string',
        'short_name'         => 'string',
        'test_type'          => 'string',
        'category_id'        => 'integer',
        'subcategory'        => 'string',
        'report_days'        => 'integer',
        'charge_category_id' => 'integer',
        'standard_charge'    => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'test_name'          => 'required|is_unique:radiology_tests,test_name',
        'short_name'         => 'required',
        'test_type'          => 'required',
        'category_id'        => 'required',
        'charge_category_id' => 'required',
        'standard_charge'    => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function radiologycategory()
    {
        return $this->belongsTo(RadiologyCategory::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function chargecategory()
    {
        return $this->belongsTo(ChargeCategory::class, 'charge_category_id');
    }
}
