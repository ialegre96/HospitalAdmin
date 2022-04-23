<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PackageService
 *
 * @property int $id
 * @property int $package_id
 * @property string $service_name
 * @property float $quantity
 * @property float $rate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PackageService newModelQuery()
 * @method static Builder|PackageService newQuery()
 * @method static Builder|PackageService query()
 * @method static Builder|PackageService whereCreatedAt($value)
 * @method static Builder|PackageService whereId($value)
 * @method static Builder|PackageService wherePackageId($value)
 * @method static Builder|PackageService whereQuantity($value)
 * @method static Builder|PackageService whereRate($value)
 * @method static Builder|PackageService whereUpdatedAt($value)
 * @mixin Eloquent
 * @property float $amount
 * @method static Builder|PackageService whereAmount($value)
 * @property int $service_id
 * @method static Builder|PackageService whereServiceId($value)
 * @property-read Service $service
 * @property int $is_default
 * @method static Builder|PackageService whereIsDefault($value)
 */
class PackageService extends Model
{
    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'service_id' => 'required|integer',
        'quantity'   => 'required|integer',
        'rate'       => 'required|regex:/^\d*(\.\d{1,2})?$/',
    ];
    public $table = 'package_services';
    public $fillable = [
        'package_id',
        'service_id',
        'quantity',
        'rate',
        'amount',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'package_id' => 'integer',
        'service_id' => 'integer',
        'quantity'   => 'double',
        'rate'       => 'double',
        'amount'     => 'double',
    ];

    /**
     * @return BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
