<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\IpdPrescription
 *
 * @property int $id
 * @property int $ipd_patient_department_id
 * @property string|null $header_note
 * @property string|null $footer_note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereFooterNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereHeaderNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereIpdPatientDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpdPrescription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|IpdPrescriptionItem[] $ipdPrescriptionItems
 * @property-read int|null $ipd_prescription_items_count
 * @property-read \App\Models\IpdPatientDepartment $ipdPatient
 * @property-read \App\Models\IpdPatientDepartment $patient
 */
class IpdPrescription extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'ipd_prescriptions';

    public $fillable = [
        'ipd_patient_department_id',
        'header_note',
        'footer_note',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'ipd_patient_department_id' => 'integer',
        'header_note'               => 'string',
        'footer_note'               => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date'           => 'nullable',
        'charge_type_id' => 'nullable',
        'category_id'    => 'required',
    ];

    /**
     * @return HasMany
     */
    public function ipdPrescriptionItems()
    {
        return $this->hasMany(IpdPrescriptionItem::class, 'ipd_prescription_id');
    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(IpdPatientDepartment::class, 'ipd_patient_department_id');
    }
}
