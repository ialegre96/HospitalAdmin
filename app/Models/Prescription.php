<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Prescription
 *
 * @version March 31, 2020, 12:22 pm UTC
 * @property int patient_id
 * @property string food_allergies
 * @property string tendency_bleed
 * @property string heart_disease
 * @property string high_blood_pressure
 * @property string diabetic
 * @property string surgery
 * @property string accident
 * @property string others
 * @property string medical_history
 * @property string current_medication
 * @property string female_pregnancy
 * @property string breast_feeding
 * @property string health_insurance
 * @property string low_income
 * @property string reference
 * @property bool status
 * @property int $id
 * @property int|null $doctor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereBreastFeeding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereCurrentMedication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereDiabetic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereFemalePregnancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereFoodAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHealthInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHeartDisease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHighBloodPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereLowIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereMedicalHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereSurgery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereTendencyBleed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereUpdatedAt($value)
 * @mixin Model
 * @property int $patient_id
 * @property string|null $food_allergies
 * @property string|null $tendency_bleed
 * @property string|null $heart_disease
 * @property string|null $high_blood_pressure
 * @property string|null $diabetic
 * @property string|null $surgery
 * @property string|null $accident
 * @property string|null $others
 * @property string|null $medical_history
 * @property string|null $current_medication
 * @property string|null $female_pregnancy
 * @property string|null $breast_feeding
 * @property string|null $health_insurance
 * @property string|null $low_income
 * @property string|null $reference
 * @property bool|null $status
 * @property int $is_default
 * @property-read \App\Models\Doctor|null $doctor
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereIsDefault($value)
 */
class Prescription extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'prescriptions';

    public $fillable = [
        'patient_id',
        'doctor_id',
        'food_allergies',
        'tendency_bleed',
        'heart_disease',
        'high_blood_pressure',
        'diabetic',
        'surgery',
        'accident',
        'others',
        'medical_history',
        'current_medication',
        'female_pregnancy',
        'breast_feeding',
        'health_insurance',
        'low_income',
        'reference',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'patient_id'          => 'integer',
        'food_allergies'      => 'string',
        'tendency_bleed'      => 'string',
        'heart_disease'       => 'string',
        'high_blood_pressure' => 'string',
        'diabetic'            => 'string',
        'surgery'             => 'string',
        'accident'            => 'string',
        'others'              => 'string',
        'medical_history'     => 'string',
        'current_medication'  => 'string',
        'female_pregnancy'    => 'string',
        'breast_feeding'      => 'string',
        'health_insurance'    => 'string',
        'low_income'          => 'string',
        'reference'           => 'string',
        'status'              => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
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
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
