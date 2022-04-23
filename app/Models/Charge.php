<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Charge
 *
 * @version April 11, 2020, 9:09 am UTC
 * @property int $id
 * @property int $charge_type
 * @property int $charge_category_id
 * @property string $code
 * @property string $standard_charge
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ChargeCategory $chargeCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereChargeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereChargeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereStandardCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereUpdatedAt($value)
 * @mixin Model
 */
class Charge extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'charges';

    public $fillable = [
        'charge_type',
        'charge_category_id',
        'code',
        'standard_charge',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'charge_type'        => 'required',
        'charge_category_id' => 'required',
        'code'               => 'required|is_unique:charges,code',
        'standard_charge'    => 'required',
    ];

    public function chargeCategory()
    {
        return $this->belongsTo(ChargeCategory::class, 'charge_category_id');
    }
}
