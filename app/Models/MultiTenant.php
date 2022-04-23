<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Events\CreatingTenant;
use Stancl\Tenancy\Events\DeletingTenant;
use Stancl\Tenancy\Events\SavingTenant;
use Stancl\Tenancy\Events\TenantDeleted;
use Stancl\Tenancy\Events\TenantSaved;
use Stancl\Tenancy\Events\TenantUpdated;
use Stancl\Tenancy\Events\UpdatingTenant;

/**
 * Class CustomTenant
 */
class MultiTenant extends BaseTenant
{
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'tenant_username',
            'hospital_name',
        ];
    }

    protected $casts = [
        'data' => 'array',
    ];

    protected $dispatchesEvents = [
        'saving'   => SavingTenant::class,
        'saved'    => TenantSaved::class,
        'creating' => CreatingTenant::class,
        //        'created' => TenantCreated::class,
        'updating' => UpdatingTenant::class,
        'updated'  => TenantUpdated::class,
        'deleting' => DeletingTenant::class,
        'deleted'  => TenantDeleted::class,
    ];
}
