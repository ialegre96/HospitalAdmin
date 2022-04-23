<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class RadiologyCategory
 *
 * @version April 11, 2020, 7:08 am UTC
 * @property string name
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RadiologyCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RadiologyCategory extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'radiology_categories';

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
        'name' => 'required|is_unique:radiology_categories,name',
    ];
}
