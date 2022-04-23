<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\Traits\HasPermissions;

/**
 * Class Department
 *
 * @version February 12, 2020, 5:39 am UTC
 * @property string name
 * @property bool is_active
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $guard_name
 * @property int $is_default
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|Department permission($permissions)
 * @method static Builder|Department whereGuardName($value)
 * @method static Builder|Department whereIsDefault($value)
 */
class Department extends Model implements RoleContract
{
    use HasPermissions;

    public $table = 'departments';

    const INACTIVE = 0;
    const ACTIVE = 1;
    const ACTIVE_ALL = 2;

    const ACTIVE_ARR = [
        self::ACTIVE_ALL => 'All',
        self::ACTIVE     => 'Active',
        self::INACTIVE   => 'Deactive',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function (self $department) {
            $department->guard_name = 'web';
        });
    }

    public $fillable = [
        'name',
        'guard_name',
        'is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
    ];

    /**
     * A role may be given various permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.permission'),
            config('permission.table_names.role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

    /**
     * A role belongs to some users of the model associated with its guard.
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(
            getModelForGuard($this->attributes['guard_name']),
            'model',
            config('permission.table_names.model_has_roles'),
            'role_id',
            config('permission.column_names.model_morph_key')
        );
    }

    /**
     * @param  string  $name
     * @param  null|string  $guardName
     *
     * @return RoleContract|Builder
     */
    public static function findByName(string $name, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw RoleDoesNotExist::named($name);
        }

        return $role;
    }

    /**
     * @param  int  $id
     * @param  null|string  $guardName
     *
     * @return RoleContract|Builder
     */
    public static function findById(int $id, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $role = static::where('id', $id)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw RoleDoesNotExist::withId($id);
        }

        return $role;
    }

    /**
     * Find or create role by its name (and optionally guardName).
     *
     * @param  string  $name
     * @param  string|null  $guardName
     *
     * @return RoleContract|Builder
     */
    public static function findOrCreate(string $name, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if ($role) {
            return $role;
        }

        return static::query()->create(['name' => $name, 'guard_name' => $guardName]);
    }
}
