<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\BloodDonor
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property int $gender
 * @property string $blood_group
 * @property Carbon $last_donate_date
 * @property int $bags
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\BloodBank $bloodBank
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereBags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereLastDonateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereUpdatedAt($value)
 * @mixin Model
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonor whereIsDefault($value)
 */
class BloodDonor extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'blood_donors';

    public $fillable = [
        'name',
        'age',
        'gender',
        'blood_group',
        'last_donate_date',
        'bags',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'name'             => 'string',
        'gender'           => 'integer',
        'blood_group'      => 'string',
        'last_donate_date' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required',
        'age'         => 'required|numeric|digits_between:1,100',
        'blood_group' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function bloodBank()
    {
        return $this->belongsTo(BloodBank::class, 'blood_group', 'blood_group');
    }
}
