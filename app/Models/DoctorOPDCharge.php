<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class DoctorOPDCharge
 *
 * @property int $id
 * @property int $doctor_id
 * @property float $standard_charge
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge whereStandardCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorOPDCharge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DoctorOPDCharge extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'doctor_opd_charges';

    /**
     * @var string[]
     */
    public $fillable = [
        'doctor_id',
        'standard_charge',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'              => 'integer',
        'doctor_id'       => 'integer',
        'standard_charge' => 'double',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'doctor_id'       => 'required|unique:doctor_opd_charges,doctor_id',
        'standard_charge' => 'required',
    ];

    /**
     * @var string[]
     */
    public static $messages = [
        'required.unique' => 'The doctor\'s name has already been taken.',
    ];

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
