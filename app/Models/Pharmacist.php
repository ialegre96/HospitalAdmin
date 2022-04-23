<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Pharmacist
 *
 * @version February 14, 2020, 9:32 am UTC
 * @property int user_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Pharmacist newModelQuery()
 * @method static Builder|Pharmacist newQuery()
 * @method static Builder|Pharmacist query()
 * @method static Builder|Pharmacist whereCreatedAt($value)
 * @method static Builder|Pharmacist whereId($value)
 * @method static Builder|Pharmacist whereUpdatedAt($value)
 * @method static Builder|Pharmacist whereUserId($value)
 * @mixin Model
 * @property-read \App\Models\Address $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeePayroll[] $payrolls
 * @property-read int|null $payrolls_count
 * @property int $user_id
 * @property int $is_default
 * @method static Builder|Pharmacist whereIsDefault($value)
 */
class Pharmacist extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'pharmacists';
    public $fillable = [
        'user_id',
    ];

    const STATUS_ALL = 2;
    const ACTIVE = 1;
    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|email:filter|is_unique:users,email',
        'designation'   => 'required|string',
        'qualification' => 'required|string',
        'password'      => 'nullable|same:password_confirmation|min:6',
        'gender'        => 'required',
        'dob'           => 'nullable|date',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }

    /**
     * @return MorphMany
     */
    public function payrolls()
    {
        return $this->morphMany(EmployeePayroll::class, 'owner');
    }
}
