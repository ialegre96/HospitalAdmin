<?php

namespace App\Http\Middleware;

use App\Resolvers\MultiTenantResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Middleware\IdentificationMiddleware;
use Stancl\Tenancy\Tenancy;

/**
 * Class CustomTenantMiddleware
 */
class MultiTenantMiddleware  extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var MultiTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, MultiTenantResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
    }
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenant = Auth::user()->tenant_id;

        return $this->initializeTenancy(
            $request, $next, $tenant
        );
    }

}
