<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * Class NoticeBoard
 *
 * @version February 18, 2020, 4:23 am UTC
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NoticeBoard whereUpdatedAt($value)
 * @mixin Model
 * @property int $id
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeBoard whereIsDefault($value)
 */
class NoticeBoard extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'notice_boards';

    public $fillable = [
        'title',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
    ];
}
