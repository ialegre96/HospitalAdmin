<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Medicine
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string $name
 * @property float $selling_price
 * @property float $buying_price
 * @property string $effect
 * @property Carbon $mfg_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Medicine newModelQuery()
 * @method static Builder|Medicine newQuery()
 * @method static Builder|Medicine query()
 * @method static Builder|Medicine whereBrandId($value)
 * @method static Builder|Medicine whereBuyingPrice($value)
 * @method static Builder|Medicine whereCategoryId($value)
 * @method static Builder|Medicine whereCreatedAt($value)
 * @method static Builder|Medicine whereId($value)
 * @method static Builder|Medicine whereName($value)
 * @method static Builder|Medicine whereSellingPrice($value)
 * @method static Builder|Medicine whereUpdatedAt($value)
 * @mixin Model
 * @property-read Brand|null $brand
 * @property-read Category|null $category
 * @property string $salt_composition
 * @property string|null $side_effects
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Medicine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Medicine whereSaltComposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Medicine whereSideEffects($value)
 * @property int $is_default
 * @method static Builder|Medicine whereIsDefault($value)
 */
class Medicine extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'medicines';

    public $fillable = [
        'category_id',
        'brand_id',
        'name',
        'selling_price',
        'buying_price',
        'side_effects',
        'description',
        'salt_composition',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'category_id'   => 'integer',
        'brand_id'      => 'integer',
        'name'          => 'string',
        'selling_price' => 'double',
        'buying_price'  => 'double',
        'side_effects'  => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id'   => 'required',
        'brand_id'      => 'required',
        'name'          => 'required|min:2|is_unique:medicines,name',
        'selling_price' => 'required',
        'buying_price'  => 'required',
        'side_effects'  => 'nullable',
    ];

    public static $messages = [
        'category_id.required' => 'The Category field is required.',
        'brand_id.required'    => 'The Brand  field is required.',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
