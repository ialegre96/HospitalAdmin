<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class LiveMeeting
 *
 * @property int $id
 * @property string $consultation_title
 * @property string $consultation_date
 * @property string $consultation_duration_minutes
 * @property int $host_video
 * @property int $participant_video
 * @property string|null $description
 * @property string $created_by
 * @property array|null $meta
 * @property string $time_zone
 * @property string $password
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $status_text
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $members
 * @property-read int|null $members_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereConsultationDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereConsultationTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereHostVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereParticipantVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $meeting_id
 * @method static \Illuminate\Database\Eloquent\Builder|LiveMeeting whereMeetingId($value)
 */
class LiveMeeting extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * @var string
     */
    protected $table = 'live_meetings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'description',
        'meta',
        'created_by',
        'password',
        'host_video',
        'participant_video',
        'status',
        'meeting_id',
    ];

    const STATUS_AWAITED = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_FINISHED = 2;

    const status = [
        self::STATUS_AWAITED   => 'Awaited',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_FINISHED  => 'Finished',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'consultation_title'            => 'required',
        'consultation_date'             => 'required',
        'consultation_duration_minutes' => 'required|min:0|max:720',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['status_text'];

    /**
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return self::status[$this->status];
    }

    /**
     * @return BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'live_meetings_candidates', 'live_meeting_id', 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
