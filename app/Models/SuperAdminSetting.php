<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $logo_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @mixin Model
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCompanyName($value)
 */
class SuperAdminSetting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const PATH = 'super_admin_settings';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'app_name'                 => 'required|max:30',
        'app_logo'                 => 'nullable|mimes:jpg,jpeg,png',
        'favicon'                  => 'nullable|mimes:jpg,jpeg,png,ico',
        'plan_expire_notification' => 'required|max:2',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $footerRules = [
        'footer_text' => 'required|max:270',
        'address'     => 'required|max:60',
        'email'       => 'required|email:filter',
        'phone'       => 'required',
    ];

    public $table = 'super_admin_settings';
    public $fillable = [
        'key',
        'value',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'key'   => 'string',
        'value' => 'string',
    ];

    /**
     * @return mixed
     */
    public function getLogoUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return $this->value;
    }
}
