<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent as Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\DocumentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Document $document
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\Patient $patient
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType whereIsDefault($value)
 */
class DocumentType extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'document_types';

    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|is_unique:document_types,name',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_type_id', 'id');
    }
}
