<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedByPathException;
use Stancl\Tenancy\Resolvers\Contracts\CachedTenantResolver;

class MultiTenantResolver extends CachedTenantResolver
{
    public static $tenantParameterName = 'tenant';

    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    public function resolveWithoutCache(...$args): Tenant
    {
        $userTenantId = null;
        if (getLoggedInUser() == null) {
            $user = User::where('username', request()->segment(2))->first();
            $userTenantId = $user->tenant_id;
        } else {
            if (getLoggedInUser()->hasRole('super_admin')) {
                $user = User::where('username', request()->segment(2))->first();
                if ($user == null) {
                    $userTenantId = getLoggedInUser()->tenant_id;
                } else {
                    $userTenantId = $user->tenant_id;
                }
            } else {
                    $userTenantId = getLoggedInUser()->tenant_id;
            }
        }

        if ($userTenantId == null) {
            return new \Stancl\Tenancy\Database\Models\Tenant();
        }

        if ($tenant = tenancy()->find($userTenantId)) {
            return $tenant;
        }

        throw new TenantCouldNotBeIdentifiedByPathException($userTenantId);
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [
            [$tenant->id],
        ];
    }
}
