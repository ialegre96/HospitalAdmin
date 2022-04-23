<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\AdvancedPayment
 *
 * @property int $id
 * @property int $patient_id
 * @property string $receipt_no
 * @property float $amount
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereReceiptNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvancedPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_default
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|AdvancedPayment whereIsDefault($value)
 */
class AdvancedPayment extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'advanced_payments';

    public $fillable = [
        'patient_id',
        'receipt_no',
        'amount',
        'date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'patient_id' => 'integer',
        'receipt_no' => 'string',
        'amount'     => 'double',
        'date'       => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
        'receipt_no' => 'required|string',
        'amount'     => 'required',
        'date'       => 'required|date',
    ];

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
