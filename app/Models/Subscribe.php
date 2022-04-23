<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property string $email
 * @property int $subscribe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereSubscribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribes';

    const SUBSCRIBE = 1;

    const SUBSCRIBER = [
        self::SUBSCRIBE => 'Subscribe',
    ];

    public $fillable = [
        'email',
        'subscribe',
    ];

    public static $rules = [
        'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:subscribes,email',
    ];
}
