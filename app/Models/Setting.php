<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

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
class Setting extends Model implements HasMedia
{
    use InteractsWithMedia, QueryCacheable, BelongsToTenant, PopulateTenantID;

    protected $cacheFor = 3600; // 1 hour

    public $table = 'settings';

    public const PATH = 'settings';

    const CURRENCIES = [
        'eur' => 'Euro (EUR)',
        'aud' => 'Australia Dollar (AUD)',
        'inr' => 'India Rupee (INR)',
        'usd' => 'USA Dollar (USD)',
        'jpy' => 'Japanese Yen (JPY)',
        'gbp' => 'British Pound (GBP)',
        'cad' => 'Canadian Dollar (CAD)',
    ];

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
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'app_name'     => 'required|string',
        'company_name' => 'required|string',
        'app_logo'     => 'nullable|mimes:jpg,jpeg,png',
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
