<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\SubscriptionPlan
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $currency
 * @property float $price
 * @property int $plan_type
 * @property int $valid_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan wherePlanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereValidUntil($value)
 */
class SubscriptionPlan extends Model
{
    use HasFactory;

    const TRAIL_DAYS = 7;
    const  MONTH = 1;
    const  YEAR = 2;

    public const PLAN_TYPE = [
        1 => 'Month',
        2 => 'Year',
    ];

    const FREQUENCY = [
        self::MONTH => 1,
        self::YEAR  => 1,
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'  => 'required|max:50|unique:subscription_plans,name',
        'price' => 'required|max:4|gte:0',
    ];
    /**
     * @var string[]
     */
    public static $editRules = [
        'name'  => 'required|max:50|unique:subscription_plans,name',
        'price' => 'required|max:4|gte:0',
    ];
    /**
     * @var string
     */
    protected $table = 'subscription_plans';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'currency',
        'price',
        'frequency',
        'is_default',
        'trial_days',
    ];

    /**
     * @return HasOne
     */
    public function plan()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function plans()
    {
        return $this->hasMany(Subscription::class)->where('user_id', getLoggedInUserId());
    }

    /**
     * @return HasMany
     */
    public function subscription()
    {
        return $this->hasMany(Subscription::class)->where('status', '=', Subscription::ACTIVE);
    }

    /**
     * @return BelongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_subscriptionplan')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function planFeatures()
    {
        return $this->hasMany(FeatureSubscriptionPlan::class, 'subscription_plan_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function hasZeroPlan()
    {
        return $this->hasMany(Subscription::class)->where('plan_amount', 0)->where('user_id', getLoggedInUserId());
    }
}
