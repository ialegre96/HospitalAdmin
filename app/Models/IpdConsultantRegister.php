<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class IpdConsultantRegister
 *
 * @version September 9, 2020, 6:56 am UTC
 * @property int $ipd_patient_department_id
 * @property string $applied_date
 * @property int $doctor_id
 * @property string $instruction
 * @property string $instruction_date
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor $doctor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereAppliedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereInstructionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister
 *     whereIpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdConsultantRegister whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IpdConsultantRegister extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'ipd_consultant_registers';

    public $fillable = [
        'ipd_patient_department_id',
        'applied_date',
        'doctor_id',
        'instruction',
        'instruction_date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'ipd_patient_department_id' => 'integer',
        'doctor_id'                 => 'integer',
        'instruction'               => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'applied_date'     => 'required',
        'doctor_id'        => 'required',
        'instruction'      => 'required',
        'instruction_date' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
