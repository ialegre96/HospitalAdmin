<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class ItemCategory
 *
 * @version August 26, 2020, 8:12 am UTC
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory query()
 * @mixin \Eloquent
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategory whereUpdatedAt($value)
 */
class ItemCategory extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|is_unique:item_categories,name',
    ];
    public $table = 'item_categories';
    public $fillable = [
        'name',
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
}
