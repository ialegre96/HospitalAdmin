<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class BloodBank
 *
 * @version February 17, 2020, 9:23 am UTC
 * @property string blood_group
 * @property int remained_bags
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BloodBank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereRemainedBags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodBank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BloodBank withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BloodBank withoutTrashed()
 * @mixin Model
 * @property string $blood_group
 * @property int $remained_bags
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|BloodBank whereIsDefault($value)
 */
class BloodBank extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'blood_banks';

    public $fillable = [
        'blood_group',
        'remained_bags',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'blood_group'   => 'string',
        'remained_bags' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'blood_group'   => 'required|is_unique:blood_banks,blood_group',
        'remained_bags' => 'required|numeric',
    ];
}
