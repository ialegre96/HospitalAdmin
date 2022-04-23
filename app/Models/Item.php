<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Item
 *
 * @version August 26, 2020, 10:11 am UTC
 * @property string $name
 * @property int $item_category_id
 * @property int $unit
 * @property string $description
 * @property int $available_quantity
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ItemCategory $itemCategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereAvailableQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ItemCategory $itemcategory
 */
class Item extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'             => 'required|is_unique:items,name',
        'item_category_id' => 'required',
        'unit'             => 'required',
        'description'      => 'nullable',
    ];
    public $table = 'items';
    public $fillable = [
        'name',
        'item_category_id',
        'unit',
        'description',
        'available_quantity',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'name'               => 'string',
        'item_category_id'   => 'integer',
        'unit'               => 'integer',
        'description'        => 'string',
        'available_quantity' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function itemcategory()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }
}
