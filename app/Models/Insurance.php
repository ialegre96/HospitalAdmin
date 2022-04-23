<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Insurance
 *
 * @version February 22, 2020, 9:01 am UTC
 * @property int $id
 * @property string $name
 * @property float $service_tax
 * @property float|null $discount
 * @property string|null $remark
 * @property string $insurance_no
 * @property string $insurance_code
 * @property float $hospital_rate
 * @property float $total
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Insurance newModelQuery()
 * @method static Builder|Insurance newQuery()
 * @method static Builder|Insurance query()
 * @method static Builder|Insurance whereCreatedAt($value)
 * @method static Builder|Insurance whereDiscount($value)
 * @method static Builder|Insurance whereHospitalRate($value)
 * @method static Builder|Insurance whereId($value)
 * @method static Builder|Insurance whereInsuranceCode($value)
 * @method static Builder|Insurance whereInsuranceNo($value)
 * @method static Builder|Insurance whereName($value)
 * @method static Builder|Insurance whereRemark($value)
 * @method static Builder|Insurance whereServiceTax($value)
 * @method static Builder|Insurance whereStatus($value)
 * @method static Builder|Insurance whereTotal($value)
 * @method static Builder|Insurance whereUpdatedAt($value)
 * @mixin Model
 * @property int $is_default
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsuranceDisease[] $insuranceDiseases
 * @property-read int|null $insurance_diseases_count
 * @method static Builder|Insurance whereIsDefault($value)
 */
class Insurance extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'name'           => 'required|is_unique:insurances,name',
        'service_tax'    => 'required',
        'insurance_no'   => 'required',
        'insurance_code' => 'required',
        'hospital_rate'  => 'required',
    ];
    /**
     * @var string
     */
    public $table = 'insurances';

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    /**
     * @var array
     */
    public $fillable = [
        'name',
        'service_tax',
        'discount',
        'remark',
        'insurance_no',
        'insurance_code',
        'hospital_rate',
        'total',
        'status',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    /**
     * @return HasMany
     */
    public function insuranceDiseases()
    {
        return $this->hasMany(InsuranceDisease::class, 'insurance_id');
    }
}
