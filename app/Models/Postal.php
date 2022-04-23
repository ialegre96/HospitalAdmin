<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class Postal
 *
 * @property int $id
 * @property string|null $from_title
 * @property string|null $to_title
 * @property string|null $reference_no
 * @property string|null $date
 * @property string|null $address
 * @property int|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $document_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Postal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Postal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Postal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereFromTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereToTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Postal extends Model implements HasMedia
{
    use InteractsWithMedia, BelongsToTenant, PopulateTenantID;

    protected $table = 'postals';

    const PATH = 'postal';
    const POSTAL_RECEIVE = 1;
    const POSTAL_DISPATCH = 2;

    /**
     * @var string[]
     */
    public $fillable = [
        'from_title',
        'to_title',
        'reference_no',
        'date',
        'address',
        'type',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'from_title' => 'required_if:type,==,'.self::POSTAL_RECEIVE,
        'to_title'   => 'required_if:type,==,'.self::POSTAL_DISPATCH,
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

        return '';
    }
}
