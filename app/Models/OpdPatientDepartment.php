<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Str;

/**
 * App\Models\OpdPatientDepartment
 *
 * @property int $id
 * @property int $patient_id
 * @property string $opd_number
 * @property string|null $height
 * @property string|null $weight
 * @property string|null $bp
 * @property string|null $symptoms
 * @property string|null $notes
 * @property Carbon $appointment_date
 * @property int|null $case_id
 * @property bool|null $is_old_patient
 * @property int|null $doctor_id
 * @property int $standard_charge
 * @property int $payment_mode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor|null $doctor
 * @property-read mixed $payment_mode_name
 * @property-read Patient $patient
 * @property-read PatientCase|null $patientCase
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereAppointmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereBp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereIsOldPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereOpdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment wherePaymentMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereStandardCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereSymptoms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpdPatientDepartment whereWeight($value)
 * @mixin \Eloquent
 */
class OpdPatientDepartment extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'opd_patient_departments';

    const PAYMENT_MODES = [
        1 => 'Cash',
        2 => 'Cheque',
    ];

    public $fillable = [
        'patient_id',
        'opd_number',
        'height',
        'weight',
        'bp',
        'symptoms',
        'notes',
        'appointment_date',
        'case_id',
        'is_old_patient',
        'doctor_id',
        'standard_charge',
        'payment_mode',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'       => 'required',
        'case_id'          => 'required',
        'appointment_date' => 'required',
        'doctor_id'        => 'required',
        'standard_charge'  => 'required',
        'payment_mode'     => 'required',
        'weight'           => 'numeric|max:200',
        'height'           => 'numeric|max:7',
    ];

    /**
     * @var array
     */
    protected $appends = ['payment_mode_name'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'patient_id'       => 'integer',
        'opd_number'       => 'string',
        'appointment_date' => 'datetime',
        'height'           => 'integer',
        'weight'           => 'integer',
        'bp'               => 'string',
        'symptoms'         => 'string',
        'notes'            => 'string',
        'case_id'          => 'integer',
        'is_old_patient'   => 'boolean',
        'doctor_id'        => 'integer',
        'standard_charge'  => 'integer',
        'payment_mode'     => 'integer',
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
    public function patientCase()
    {
        return $this->belongsTo(PatientCase::class, 'case_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return string
     */
    public static function generateUniqueOpdNumber()
    {
        $opdNumber = strtoupper(Str::random(8));
        while (true) {
            $isExist = self::whereOpdNumber($opdNumber)->exists();
            if ($isExist) {
                self::generateUniqueOpdNumber();
            }
            break;
        }

        return $opdNumber;
    }

    /**
     * @return mixed
     */
    public function getPaymentModeNameAttribute()
    {
        return self::PAYMENT_MODES[$this->payment_mode];
    }
}
