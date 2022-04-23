<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\DiagnosisCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DiagnosisCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DiagnosisCategory extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'diagnosis_categories';

    public $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|is_unique:diagnosis_categories,name',
    ];
}
