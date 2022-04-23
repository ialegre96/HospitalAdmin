<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class PathologyCategory
 *
 * @version April 11, 2020, 5:39 am UTC
 * @property string name
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PathologyCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PathologyCategory extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'pathology_categories';

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

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|is_unique:pathology_categories,name',
    ];
}
