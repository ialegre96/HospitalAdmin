<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Sms
 *
 * @property int $id
 * @property int|null $send_to
 * @property string|null $region_code
 * @property string $phone_number
 * @property string $message
 * @property int $send_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $sendBy
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereSendBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereSendTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sms whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sms extends Model
{
    use BelongsToTenant, PopulateTenantID;

    protected $table = 'sms';

    public $fillable = ['send_to', 'phone_number', 'message', 'send_by', 'region_code'];

    const ROLE_TYPES = [
        1 => 'Doctor',
        2 => 'Accountant',
        3 => 'Nurse',
        4 => 'LabTechnician',
        5 => 'Receptionist',
        6 => 'Pharmacist',
        7 => 'Case Handler',
        8 => 'Patient',
    ];

    const CLASS_TYPES = [
        1 => Doctor::class,
        2 => Accountant::class,
        3 => Nurse::class,
        4 => LabTechnician::class,
        5 => Receptionist::class,
        6 => Pharmacist::class,
        7 => CaseHandler::class,
        8 => Patient::class,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'message' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'message' => 'required|max:160',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'send_to');
    }

    /**
     * @return BelongsTo
     */
    public function sendBy()
    {
        return $this->belongsTo(User::class, 'send_by');
    }
}
