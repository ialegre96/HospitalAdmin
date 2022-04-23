<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Vaccination
 *
 * @property int $id
 * @property string $name
 * @property string $manufactured_by
 * @property string $brand
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereManufacturedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vaccination whereUpdatedAt($value)
 * @mixin Model
 */
class Vaccination extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'            => 'required',
        'manufactured_by' => 'required',
        'brand'           => 'required',
    ];
    public $table = 'vaccinations';
    public $fillable = [
        'name',
        'manufactured_by',
        'brand',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'name'            => 'string',
        'manufactured_by' => 'string',
        'brand'           => 'string',
    ];
}
