<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Doctor
 *
 * @version February 13, 2020, 8:55 am UTC
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Doctor newModelQuery()
 * @method static Builder|Doctor newQuery()
 * @method static Builder|Doctor query()
 * @method static Builder|Doctor whereCreatedAt($value)
 * @method static Builder|Doctor whereId($value)
 * @method static Builder|Doctor whereSpecialist($value)
 * @method static Builder|Doctor whereUpdatedAt($value)
 * @method static Builder|Doctor whereUserId($value)
 * @mixin Model
 * @property int $user_id
 * @property int $department_id
 * @property string $specialist
 * @property-read Address $address
 * @method static Builder|Doctor whereDepartmentId($value)
 * @property int $doctor_department_id
 * @method static Builder|Doctor whereDoctorDepartmentId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PatientCase[] $cases
 * @property-read int|null $cases_count
 * @property-read \App\Models\DoctorDepartment $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read int|null $patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeePayroll[] $payrolls
 * @property-read int|null $payrolls_count
 * @property int $is_default
 * @method static Builder|Doctor whereIsDefault($value)
 */
class Doctor extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'doctors';

    public $fillable = [
        'user_id',
        'doctor_department_id',
        'specialist',
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
        'id'                   => 'integer',
        'user_id'              => 'integer',
        'doctor_department_id' => 'integer',
        'specialist'           => 'string',
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
        'password'      => 'nullable|same:password_confirmation|min:6',
        'designation'   => 'required',
        'gender'        => 'required',
        'qualification' => 'required',
        'dob'           => 'nullable|date',
        'specialist'    => 'required',
        'phone'         => 'nullable|numeric',
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
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(DoctorDepartment::class, 'doctor_department_id');
    }

    /**
     * @return HasMany
     */
    public function cases()
    {
        return $this->hasMany(PatientCase::class, 'doctor_id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_cases', 'doctor_id', 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * @return HasMany
     */
    public function schedules()
    {
        return $this->hasMany(ScheduleDay::class, 'doctor_id');
    }

    /**
     * @return MorphMany
     */
    public function payrolls()
    {
        return $this->morphMany(EmployeePayroll::class, 'owner');
    }
}
