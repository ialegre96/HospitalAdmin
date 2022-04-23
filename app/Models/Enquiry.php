<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Enquiry
 *
 * @property int $id
 * @property string $full_name
 * @property int $contact_no
 * @property string $type
 * @property mixed $message
 * @property int $viewed_by
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereContactNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enquiry whereViewedBy($value)
 * @mixin Eloquent
 * @property string $email
 * @property int $is_default
 * @property-read mixed $enquiry_type
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereIsDefault($value)
 */
class Enquiry extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'enquiries';

    public $fillable = [
        'full_name',
        'email',
        'contact_no',
        'type',
        'message',
        'viewed_by',
        'status',
    ];

    const ALL = 2;
    const READ = 1;
    const UNREAD = 0;

    const STATUS_ARR = [
        self::ALL    => 'All',
        self::READ   => 'Read',
        self::UNREAD => 'Unread',
    ];

    const TYPE_GENERAL = 'General Inquiry';
    const TYPE_FEEDBACK = 'Feedback/Suggestions';
    const TYPE_RESIDENTIAL = 'Residential Care';

    public $appends = ['enquiry_type'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'full_name'  => 'string',
        'email'      => 'string',
        'contact_no' => 'string',
        'type'       => 'integer',
        'message'    => 'string',
        'viewed_by'  => 'integer',
        'status'     => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'full_name'  => 'required',
        'email'      => 'required|email:filter',
        'contact_no' => 'required|numeric',
        'type'       => 'required',
        'message'    => 'required|max:5000',
    ];


    /**
     * @var string[]
     */
    public static $reCaptchaAttributes = [
        'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
        'g-recaptcha-response.required'  => 'The Google reCaptcha field is required',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'viewed_by');
    }

    /**
     * Mutator to access enquiry name based on enquiry type
     *
     * @return mixed
     */
    public function getEnquiryTypeAttribute()
    {
        if ($this->type == 1) {
            return self::TYPE_GENERAL;
        } elseif ($this->type == 2) {
            return self::TYPE_FEEDBACK;
        } elseif ($this->type == 3) {
            return self::TYPE_RESIDENTIAL;
        }
    }
}
