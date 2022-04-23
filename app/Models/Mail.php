<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Mail
 *
 * @property int $id
 * @property string $to
 * @property string $subject
 * @property mixed $message
 * @property string|null $attachments
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereUserId($value)
 * @mixin \Eloquent
 */
class Mail extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'mails';

    public $fillable = ['to', 'subject', 'message', 'attachments', 'user_id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'to'          => 'string',
        'subject'     => 'string',
        'message'     => 'string',
        'attachments' => 'string',
        'user_id'     => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'to'          => 'required|email',
        'subject'     => 'required',
        'message'     => 'required',
        'attachments' => 'nullable|mimes:jpeg,gif,png,,jpg,mp3',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
