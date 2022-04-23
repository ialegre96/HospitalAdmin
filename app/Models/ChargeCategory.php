<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class ChargeCategory
 *
 * @version April 11, 2020, 5:26 am UTC
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $charge_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereChargeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChargeCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChargeCategory extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'charge_categories';

    const CHARGE_TYPES = [
        2 => 'Investigations',
        4 => 'Operation Theatre',
        5 => 'Others',
        1 => 'Procedures',
        3 => 'Supplier',
    ];

    const FILTER_CHARGE_TYPES = [
        0 => 'All',
        1 => 'Procedures',
        2 => 'Investigations',
        3 => 'Supplier',
        4 => 'Operation Theatre',
        5 => 'Others',
    ];

    public $fillable = [
        'name',
        'description',
        'charge_type',
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
        'name'        => 'required|is_unique:charge_categories,name',
        'description' => 'nullable',
        'charge_type' => 'required',
    ];
}
