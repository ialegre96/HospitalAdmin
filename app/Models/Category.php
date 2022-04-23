<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Category
 *
 * @version February 6, 2020, 3:16 am UTC
 * @property string name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category withTrashed()
 * @method static Builder|Category withoutTrashed()
 * @mixin Model
 * @property int $is_active
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereIsActive($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @property-read \App\Models\Brand $brand
 * @property int $is_default
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsDefault($value)
 */
class Category extends Model
{
    use BelongsToTenant, PopulateTenantID, HasFactory;

    public $table = 'categories';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'name', 'is_active',
    ];

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|is_unique:categories,name',
    ];

    /**
     * @return HasMany
     */
    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
