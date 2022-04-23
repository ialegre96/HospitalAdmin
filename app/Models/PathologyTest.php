<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class PathologyTest
 *
 * @version April 14, 2020, 9:33 am UTC
 * @property string test_name
 * @property string short_name
 * @property string test_type
 * @property int category_id
 * @property int unit
 * @property string subcategory
 * @property string method
 * @property int report_days
 * @property int charge_category_id
 * @property int standard_charge
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\ChargeCategory $chargecategory
 * @property-read \App\Models\RadiologyCategory $radiologycategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereChargeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereReportDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereStandardCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereSubcategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereTestName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereTestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PathologyTest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $test_name
 * @property string $short_name
 * @property string $test_type
 * @property int $category_id
 * @property int|null $unit
 * @property string|null $subcategory
 * @property string|null $method
 * @property int|null $report_days
 * @property int $charge_category_id
 * @property int $standard_charge
 * @property-read \App\Models\PathologyCategory $pathologycategory
 */
class PathologyTest extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'pathology_tests';

    public $fillable = [
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
        'unit'               => 'integer',
        'subcategory'        => 'string',
        'method'             => 'string',
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
        'test_name'          => 'required|is_unique:pathology_tests,test_name',
        'short_name'         => 'required',
        'test_type'          => 'required',
        'category_id'        => 'required',
        'charge_category_id' => 'required',
        'standard_charge'    => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function pathologycategory()
    {
        return $this->belongsTo(PathologyCategory::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function chargecategory()
    {
        return $this->belongsTo(ChargeCategory::class, 'charge_category_id');
    }
}
