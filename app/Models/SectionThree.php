<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\SectionThree
 *
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $text_main
 * @property string $text_secondary
 * @property string $img_url
 * @property string $text_one
 * @property string $text_two
 * @property string|null $text_three
 * @property string|null $text_four
 * @property string|null $text_five
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextFive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereTextTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionThree whereUpdatedAt($value)
 */
class SectionThree extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SECTION_THREE_PATH = 'section_three';

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'text_main'      => 'required|string|max:30',
        'text_secondary' => 'required|string|max:160',
        'img_url'        => 'mimes:jpeg,jpg,png',
        'text_one'       => 'required|string|max:50',
        'text_two'       => 'required|string|max:50',
        'text_three'     => 'nullable|string|max:50',
        'text_four'      => 'nullable|string|max:50',
        'text_five'      => 'nullable|string|max:50',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'text_main',
        'text_secondary',
        'img_url',
        'text_one',
        'text_two',
        'text_three',
        'text_four',
        'text_five',
    ];
}
