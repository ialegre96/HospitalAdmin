<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int|null $subscription_plan_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read SubscriptionPlan|null $SubscriptionPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereSubscriptionPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUserId($value)
 */
class Subscription extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const TYPE_FREE = 0;
    const TYPE_STRIPE = 1;
    const TYPE_PAYPAL = 2;
    const TYPE_RAZORPAY = 3;
    const TYPE_CASH = 4;

    const PAYMENT_TYPES = [
        self::TYPE_FREE     => 'Free Plan',
        self::TYPE_STRIPE   => 'Stripe',
        self::TYPE_PAYPAL   => 'PayPal',
        self::TYPE_RAZORPAY => 'Razorpay',
        self::TYPE_CASH     => 'Manual',
    ];

    const STATUS_ARR = [
        self::ACTIVE   => 'Active',
        self::INACTIVE => 'Deactive',
    ];
    const MONTH = 'Month';
    const YEAR = 'Year';


    public $fillable = [
        'user_id', 'subscription_plan_id', 'transaction_id', 'plan_amount', 'plan_frequency', 'starts_at', 'ends_at',
        'trial_ends_at', 'status',
    ];

    /**
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * @var string[]
     */
    protected $casts = [
        'user_id'              => 'integer',
        'subscription_plan_id' => 'integer',
        'transaction_id'       => 'integer',
        'starts_at'            => 'datetime',
        'ends_at'              => 'datetime',
        'trial_ends_at'        => 'datetime',
        'status'               => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }

    public function isExpired()
    {
        $now = Carbon::now();

        // this means the subscription is ended.
        if ((!empty($this->trial_ends_at) && $this->trial_ends_at < $now) || $this->ends_at < $now) {
            return true;
        }

        // this means the subscription is not ended.
        return false;
    }
}
