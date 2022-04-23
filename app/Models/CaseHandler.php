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
 * Class CaseHandler
 *
 * @version February 28, 2020, 3:14 am UTC
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address $address
 * @property-read User $user
 * @method static Builder|CaseHandler newModelQuery()
 * @method static Builder|CaseHandler newQuery()
 * @method static Builder|CaseHandler query()
 * @method static Builder|CaseHandler whereCreatedAt($value)
 * @method static Builder|CaseHandler whereId($value)
 * @method static Builder|CaseHandler whereUpdatedAt($value)
 * @method static Builder|CaseHandler whereUserId($value)
 * @mixin Model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeePayroll[] $payrolls
 * @property-read int|null $payrolls_count
 * @property int $is_default
 * @method static Builder|CaseHandler whereIsDefault($value)
 */
class CaseHandler extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|email|is_unique:users,email',
        'password'      => 'nullable|same:password_confirmation|min:6',
        'designation'   => 'required',
        'qualification' => 'required',
        'phone'         => 'nullable|numeric',
    ];
    public $table = 'case_handlers';
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
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
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
