<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeatureSubscriptionPlan extends Model
{
    use HasFactory;

    public $table = 'feature_subscriptionplan';

    public $fillable = [
        'feature_id',
        'subscription_plan_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'                   => 'integer',
        'feature_id'           => 'integer',
        'subscription_plan_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
