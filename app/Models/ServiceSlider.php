<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\ServiceSlider
 *
 * @property int $id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|ServiceSlider newModelQuery()
 * @method static Builder|ServiceSlider newQuery()
 * @method static Builder|ServiceSlider query()
 * @method static Builder|ServiceSlider whereCreatedAt($value)
 * @method static Builder|ServiceSlider whereId($value)
 * @method static Builder|ServiceSlider whereStatus($value)
 * @method static Builder|ServiceSlider whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ServiceSlider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SERVICE_SLIDER = 'service_slider';


    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'image' => 'mimes:jpeg,jpg,png,svg',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'image',
    ];

    protected $appends = ['image_url'];

    /**
     * @return mixed
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SERVICE_SLIDER)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web_front/images/main-banner/banner-one/woman-doctor.png');
    }
}
