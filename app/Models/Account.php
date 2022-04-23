<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string $description
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Account newModelQuery()
 * @method static Builder|Account newQuery()
 * @method static Builder|Account query()
 * @method static Builder|Account whereCreatedAt($value)
 * @method static Builder|Account whereDescription($value)
 * @method static Builder|Account whereId($value)
 * @method static Builder|Account whereName($value)
 * @method static Builder|Account whereStatus($value)
 * @method static Builder|Account whereType($value)
 * @method static Builder|Account whereUpdatedAt($value)
 * @mixin Model
 * @property-read mixed $type_label
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property int $is_default
 * @method static Builder|Account whereIsDefault($value)
 */
class Account extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'accounts';

    public $appends = ['type_label'];

    public $fillable = [
        'name',
        'type',
        'description',
        'status',
    ];

    const INACTIVE = 0;
    const ACTIVE = 1;
    const ACTIVE_ALL = 2;

    const STATUS_ARR = [
        self::ACTIVE_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    const DEBIT = 1;
    const CREDIT = 2;
    const TYPE_ALL = 0;
    const TYPE_ARR = [
        self::TYPE_ALL => 'All',
        self::DEBIT    => 'Debit',
        self::CREDIT   => 'Credit',
    ];
    const ACCOUNT_TYPES = [
        self::TYPE_ALL => 'All',
        self::CREDIT   => 'Credit',
        self::DEBIT    => 'Debit',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'status'      => 'boolean',
        'type'        => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'   => 'required|string|is_unique:accounts,name',
        'type'   => 'required|integer',
        'status' => 'nullable|integer',
    ];

    public function getTypeLabelAttribute()
    {
        return ($this->type > 1) ? self::TYPE_ARR[self::CREDIT] : self::TYPE_ARR[self::DEBIT];
    }

    /**
     * @return HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'account_id');
    }
}
