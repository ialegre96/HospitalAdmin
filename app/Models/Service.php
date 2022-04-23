<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Service
 *
 * @version February 25, 2020, 10:50 am UTC
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $quantity
 * @property int $rate
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereDeletedAt($value)
 * @method static Builder|Service whereDescription($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereQuantity($value)
 * @method static Builder|Service whereRate($value)
 * @method static Builder|Service whereStatus($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @mixin Model
 * @property int $is_default
 * @method static Builder|Service whereIsDefault($value)
 */
class Service extends Model
{
    use BelongsToTenant, PopulateTenantID; 
    
    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'name'     => 'required|is_unique:services,name',
        'quantity' => 'required|numeric',
        'rate'     => 'required',
    ];
    public $table = 'services';
    public $fillable = [
        'name',
        'description',
        'quantity',
        'rate',
        'status',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'quantity'    => 'integer',
        'rate'        => 'integer',
        'status'      => 'integer',
    ];
}
