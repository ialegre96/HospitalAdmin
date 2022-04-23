<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\SectionOne
 *
 * @property int $id
 * @property string $text_main
 * @property string $text_secondary
 * @property string $img_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereTextMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionOne whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionOne extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SECTION_ONE_PATH = 'section_one';
    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'text_main'      => 'required|string|max:45',
        'text_secondary' => 'required|string|max:135',
        'img_url'        => 'mimes:jpeg,jpg,png',
    ];
    /**
     * @var array
     */
    public $fillable = [
        'text_main',
        'text_secondary',
        'img_url',
    ];
}
