<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\SuperAdminEnquiry
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SuperAdminEnquiry newModelQuery()
 * @method static Builder|SuperAdminEnquiry newQuery()
 * @method static Builder|SuperAdminEnquiry query()
 * @method static Builder|SuperAdminEnquiry whereCreatedAt($value)
 * @method static Builder|SuperAdminEnquiry whereEmail($value)
 * @method static Builder|SuperAdminEnquiry whereFirstName($value)
 * @method static Builder|SuperAdminEnquiry whereId($value)
 * @method static Builder|SuperAdminEnquiry whereLastName($value)
 * @method static Builder|SuperAdminEnquiry whereMessage($value)
 * @method static Builder|SuperAdminEnquiry wherePhone($value)
 * @method static Builder|SuperAdminEnquiry whereStatus($value)
 * @method static Builder|SuperAdminEnquiry whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SuperAdminEnquiry extends Model
{
    use HasFactory;
    
    public $table = 'super_admin_enquiries';

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
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

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'first_name' => 'string',
        'last_name'  => 'string',
        'email'      => 'string',
        'phone'      => 'string',
        'message'    => 'string',
        'status'     => 'boolean',
    ];
    
    protected $appends = ['full_name'];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email:filter',
        'phone'      => 'required',
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
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }
}
