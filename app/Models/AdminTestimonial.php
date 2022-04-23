<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdminTestimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'testimonials';


    /**
     * @var string
     */
    public $table = 'admin_testimonials';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'position',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['image_url'];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'position'    => 'string',
        'description' => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'        => 'required|string|max:255',
        'position'    => 'required',
        'description' => 'required|max:295',
    ];

    public function getImageUrlAttribute()
    {
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/landing-theme/images/testimonial/01.jpg');
    }
}
