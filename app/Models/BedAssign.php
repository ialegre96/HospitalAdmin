<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class BedAssign
 *
 * @version February 18, 2020, 6:49 am UTC
 * @property int $id
 * @property int $patient_id
 * @property string $assign_date
 * @property string|null $discharge_date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $patient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereAssignDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereDischargeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $case_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereCaseId($value)
 * @property int $bed_id
 * @property-read \App\Models\Bed $bed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereBedId($value)
 * @property int $status
 * @property-read PatientCase $caseFromBedAssign
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereStatus($value)
 * @property int|null $ipd_patient_department_id
 * @property-read IpdPatientDepartment|null $ipdPatient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BedAssign whereIpdPatientDepartmentId($value)
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|BedAssign whereIsDefault($value)
 */
class BedAssign extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'bed_assigns';

    /**
     * @var array
     */
    public $fillable = [
        'bed_id',
        'ipd_patient_department_id',
        'patient_id',
        'case_id',
        'assign_date',
        'discharge_date',
        'description',
        'status',
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
        'id'                        => 'integer',
        'bed_id'                    => 'integer',
        'ipd_patient_department_id' => 'integer',
        'patient_id'                => 'integer',
        'case_id'                   => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bed_id'         => 'required',
        'case_id'        => 'required',
        'assign_date'    => 'required',
        'discharge_date' => 'nullable|after:assign_date',
        'description'    => 'nullable',
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
    public function bed()
    {
        return $this->belongsTo(Bed::class, 'bed_id');
    }

    /**
     * @return BelongsTo
     */
    public function caseFromBedAssign()
    {
        return $this->belongsTo(PatientCase::class, 'case_id', 'case_id');
    }

    /**
     * @return BelongsTo
     */
    public function ipdPatient()
    {
        return $this->belongsTo(IpdPatientDepartment::class, 'ipd_patient_department_id');
    }
}
