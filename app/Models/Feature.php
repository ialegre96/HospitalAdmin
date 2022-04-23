<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    public static $rules = [
        'name' => 'required|unique:features,name',
    ];
    public $table = 'features';
    public $fillable = [
        'name',
        'submenu',
        'route',
        'has_parent',
        'is_default',
    ];
    /**
     * @var string[]
     */
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'submenu'    => 'integer',
        'route'      => 'array',
        'has_parent' => 'integer',
        'is_default' => 'integer',
    ];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeHasParent($query)
    {
        return $query->where('has_parent', '=', 0);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeIsDefault($query)
    {
        return $query->where('is_default', '=', 0);
    }
}
