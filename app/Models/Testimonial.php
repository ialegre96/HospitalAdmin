<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Testimonial
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $document_url
 * @property-read Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia, BelongsToTenant, PopulateTenantID;

    const PATH = 'testimonials';
    protected $table = 'testimonials';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required',
        'description' => 'required',
    ];

    /**
     * @var array
     */
    protected $appends = ['document_url'];

    /**
     * @return mixed
     */
    public function getDocumentUrlAttribute()
    {
        /**
         * @var Media $media
         */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return getUserImageInitial($this->id, $this->name);
    }
}
