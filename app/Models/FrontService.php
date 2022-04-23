<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FrontService extends Model implements HasMedia
{
    use BelongsToTenant, HasFactory, InteractsWithMedia;

    public $table = 'front_services';

    public const PATH = 'front-services';

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'              => 'required',
        'short_description' => 'required',
    ];

    protected $fillable = [
        'name',
        'short_description',
    ];

    protected $appends = ['icon_url'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'name'              => 'string',
        'short_description' => 'string',
    ];

    /**
     * @return mixed
     */
    public function getIconUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return $this->value;
    }
}
