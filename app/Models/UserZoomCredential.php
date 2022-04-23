<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\UserZoomCredential
 *
 * @property int $id
 * @property int $user_id
 * @property string $zoom_api_key
 * @property string $zoom_api_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereZoomApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserZoomCredential whereZoomApiSecret($value)
 * @mixin \Eloquent
 */
class UserZoomCredential extends Model
{
    use BelongsToTenant, PopulateTenantID;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'zoom_api_key'    => 'required',
        'zoom_api_secret' => 'required',
    ];
    protected $table = 'user_zoom_credential';
    protected $fillable = [
        'user_id',
        'zoom_api_key',
        'zoom_api_secret',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
