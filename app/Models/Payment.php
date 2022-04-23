<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Payment
 *
 * @version February 22, 2020, 7:06 am UTC
 * @property int $id
 * @property string $payment_date
 * @property int $account_id
 * @property string $pay_to
 * @property float $amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePayTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIsDefault($value)
 */
class Payment extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'payments';

    /**
     * @var array
     */
    public $fillable = [
        'payment_date',
        'account_id',
        'pay_to',
        'description',
        'amount',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'account_id' => 'integer',
        'pay_to'     => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'payment_date' => 'required',
        'account_id'   => 'required',
        'pay_to'       => 'required',
        'amount'       => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return BelongsTo
     */
    public function accounts()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
