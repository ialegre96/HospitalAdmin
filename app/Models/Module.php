<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Module
 *
 * @property int $id
 * @property string $name
 * @property string $tenant_id
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUpdatedAt($value)
 * @mixin Model
 * @property string|null $route
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereRoute($value)
 */
class Module extends Model
{
    use QueryCacheable, BelongsToTenant, PopulateTenantID;

//    public $cacheFor = 3600; // cache time, in seconds

    /**
     * @var string
     */
    public $table = 'modules';

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    /** @var string[]* */
    public $fillable = [
        'name',
        'is_active',
        'route',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'      => 'string',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:2|unique:modules,name',
    ];
}
