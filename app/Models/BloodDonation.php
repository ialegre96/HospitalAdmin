<?php

namespace App\Models;

use App\Traits\PopulateTenantID;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\BloodDonation
 *
 * @property int $id
 * @property int $blood_donor_id
 * @property int $bags
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read BloodDonor $bloodDonor
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation whereBags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation whereBloodDonorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodDonation whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\BloodDonor $blooddonor
 */
class BloodDonation extends Model
{
    use BelongsToTenant, PopulateTenantID;

    public $table = 'blood_donations';

    public $fillable = [
        'blood_donor_id',
        'bags',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'blood_donor_id' => 'required',
        'bags'           => 'required|numeric|digits_between:1,100',
    ];

    /**
     * @return BelongsTo
     */
    public function blooddonor()
    {
        return $this->belongsTo(BloodDonor::class, 'blood_donor_id');
    }
}
