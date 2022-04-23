<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class AmbulanceCall
 *
 * @version March 27, 2020, 9:47 am UTC
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|AmbulanceCall newModelQuery()
 * @method static Builder|AmbulanceCall newQuery()
 * @method static Builder|AmbulanceCall query()
 * @method static Builder|AmbulanceCall whereAmount($value)
 * @method static Builder|AmbulanceCall whereDate($value)
 * @method static Builder|AmbulanceCall whereCreatedAt($value)
 * @method static Builder|AmbulanceCall whereId($value)
 * @method static Builder|AmbulanceCall wherePatientId($value)
 * @method static Builder|AmbulanceCall whereUpdatedAt($value)
 * @mixin Model
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon $bill_date
 * @property float $amount
 * @property-read Collection|BillItems[] $billItems
 * @property-read int|null $bill_items_count
 * @property-read \App\Models\User $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AmbulanceCall wherePatientAdmissionId($value)
 * @property int $ambulance_id
 * @property string $driver_name
 * @property \Illuminate\Support\Carbon $date
 * @property-read \App\Models\Ambulance $ambulance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AmbulanceCall whereAmbulanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AmbulanceCall whereDriverName($value)
 * @property int $is_default
 * @method static Builder|AmbulanceCall whereIsDefault($value)
 */
class AmbulanceCall extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required|integer|min:1',
        'date'       => 'required|string',
    ];

    public static $messages = [
        'min' => 'Please select at least one patient.',
    ];

    public $table = 'ambulance_calls';

    public $fillable = [
        'ambulance_id',
        'patient_id',
        'driver_name',
        'date',
        'amount',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'patient_id'   => 'integer',
        'ambulance_id' => 'integer',
        'driver_name'  => 'string',
        'date'         => 'datetime',
        'amount'       => 'double',
    ];

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class, 'ambulance_id');
    }

    public function setBillDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
