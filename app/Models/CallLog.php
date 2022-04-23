<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\CallLog
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $date
 * @property string|null $follow_up_date
 * @property string|null $note
 * @property int $call_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereCallType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereFollowUpDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CallLog extends Model
{
    use BelongsToTenant, PopulateTenantID;

    protected $table = 'call_logs';
    const INCOMING = 1;
    const OUTCOMING = 2;
    const CALLTYPE_ARR = [
        '0' => 'All',
        '1' => 'Incoming',
        '2' => 'Outgoing',
    ];

    protected $fillable = [
        'name',
        'phone',
        'date',
        'description',
        'follow_up_date',
        'note',
        'call_type',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];
}
