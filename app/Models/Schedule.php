<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Schedule
 *
 * @version February 24, 2020, 5:55 am UTC
 * @property int $id
 * @property int $doctor_id
 * @property string $per_patient_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor $doctor
 * @method static Builder|Schedule newModelQuery()
 * @method static Builder|Schedule newQuery()
 * @method static Builder|Schedule query()
 * @method static Builder|Schedule whereCreatedAt($value)
 * @method static Builder|Schedule whereDoctorId($value)
 * @method static Builder|Schedule whereId($value)
 * @method static Builder|Schedule wherePerPatientTime($value)
 * @method static Builder|Schedule whereSerialVisibility($value)
 * @method static Builder|Schedule whereUpdatedAt($value)
 * @mixin Model
 * @property-read Collection|ScheduleDay[] $scheduleDays
 * @property-read int|null $schedule_days_count
 * @property int $is_default
 * @method static Builder|Schedule whereIsDefault($value)
 */
class Schedule extends Model
{
    use BelongsToTenant, PopulateTenantID;

    const days = [
        'Monday'    => 'Monday',
        'Tuesday'   => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday'  => 'Thursday',
        'Friday'    => 'Friday',
        'Saturday'  => 'Saturday',
        'Sunday'    => 'Sunday',
    ];

    const ALL = 0;
    const Sequential = 1;
    const Timestamp = 2;

    const serialVisibility = [
        self::ALL        => 'All',
        self::Sequential => 'Sequential',
        self::Timestamp  => 'Timestamp',
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'doctor_id'        => 'required|unique:schedules,doctor_id',
        'available_on'     => 'required',
        'available_from'   => 'required',
        'available_to'     => 'required',
        'per_patient_time' => 'required',
    ];
    /**
     * @var string
     */
    public $table = 'schedules';
    /**
     * @var array
     */
    public $fillable = [
        'doctor_id',
        'per_patient_time',
    ];
    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'doctor_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return HasMany
     */
    public function scheduleDays()
    {
        return $this->hasMany(ScheduleDay::class, 'schedule_id');
    }
}
