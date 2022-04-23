<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $type
 * @property int $notification_for
 * @property int $user_id
 * @property string $title
 * @property string|null $text
 * @property string|null $meta
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotificationFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    public $table = 'notifications';

    /**
     * @var string[]
     */
    public $fillable = [
        'type',
        'notification_for',
        'user_id',
        'title',
        'text',
        'meta',
        'read_at',
    ];

    const SUPER_ADMIN = 'Super Admin';
    const ADMIN = 'Admin';
    const DOCTOR = 'Doctor';
    const RECEPTIONIST = 'Receptionist';
    const PATIENT = 'Patient';
    const NURSE = 'Nurse';
    const CASE_HANDLER = 'Case Manager';
    const PHARMACIST = 'Pharmacist';
    const ACCOUNTANT = 'Accountant';
    const LAB_TECHNICIAN = 'Lab Technician';

    const NOTIFICATION_FOR = [
        self::ADMIN          => 1,
        self::DOCTOR         => 2,
        self::RECEPTIONIST   => 3,
        self::PATIENT        => 4,
        self::NURSE          => 5,
        self::CASE_HANDLER   => 6,
        self::PHARMACIST     => 7,
        self::ACCOUNTANT     => 8,
        self::LAB_TECHNICIAN => 9,
        self::SUPER_ADMIN    => 10,
    ];

    const NOTIFICATION_TYPE = [
        'Appointment'       => 1,
        'Invoice'           => 2,
        'Bills'             => 3,
        'IPD Patient'       => 4,
        'OPD Patient'       => 5,
        'Prescription'      => 6,
        'IPD Charge'        => 7,
        'IPD Prescription'  => 8,
        'OPD Diagnosis'     => 9,
        'Employee Payrolls' => 10,
        'Advance Payment'   => 11,
        'Patient'           => 12,
        'Cases'             => 13,
        'Visitor'           => 14,
        'NoticeBoard'       => 15,
        'Bed Assign'        => 16,
        'Ambulance'         => 17,
        'Service'           => 18,
        'Income'            => 19,
        'Expense'           => 20,
        'Live Consultation' => 21,
        'Live Meeting'      => 22,
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
