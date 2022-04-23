<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Brand
 *
 * @version February 13, 2020, 4:28 am UTC
 * @property string name
 * @property string email
 * @property string phone
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereUpdatedAt($value)
 * @mixin Model
 * @property-read Collection|Medicine[] $medicines
 * @property-read int|null $medicines_count
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property int $is_default
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsDefault($value)
 */
class Brand extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'brands';

    public $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'name'  => 'string',
        'email' => 'string',
        'phone' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|is_unique:brands,name',
        'email' => 'nullable|email|is_unique:brands,email',
        'phone' => 'nullable|numeric',
    ];

    /**
     * @return HasMany
     */
    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'brand_id');
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
