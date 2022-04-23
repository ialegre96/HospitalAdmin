<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    use HasFactory;

    public $table = 'faqs';
    public $fillable = [
        'question',
        'answer',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'       => 'integer',
        'question' => 'string',
        'answer'   => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'question' => 'required|string|max:200',
        'answer'   => 'required|string|max:500',
    ];
}
