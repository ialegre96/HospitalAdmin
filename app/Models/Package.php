<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Package
 *
 * @version February 25, 2020, 1:10 pm UTC
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $discount
 * @property float $total_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Package newModelQuery()
 * @method static Builder|Package newQuery()
 * @method static Builder|Package query()
 * @method static Builder|Package whereCreatedAt($value)
 * @method static Builder|Package whereDescription($value)
 * @method static Builder|Package whereDiscount($value)
 * @method static Builder|Package whereId($value)
 * @method static Builder|Package whereName($value)
 * @method static Builder|Package whereTotalAmount($value)
 * @method static Builder|Package whereUpdatedAt($value)
 * @mixin Model
 * @property-read Collection|PackageService[] $packageServicesItems
 * @property-read int|null $package_services_items_count
 * @property int $is_default
 * @method static Builder|Package whereIsDefault($value)
 */
class Package extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'name'         => 'required|is_unique:packages,name',
        'discount'     => 'required',
        'total_amount' => 'required',
    ];
    public $table = 'packages';
    public $fillable = [
        'name',
        'description',
        'discount',
        'total_amount',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'name'         => 'string',
        'description'  => 'string',
        'discount'     => 'double',
        'total_amount' => 'double',
    ];

    /**
     * @return HasMany
     */
    public function packageServicesItems()
    {
        return $this->hasMany(PackageService::class);
    }
}
