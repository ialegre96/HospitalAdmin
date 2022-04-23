<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckImpersonateUser;
use App\Http\Middleware\CheckMenuAccess;
use App\Http\Middleware\CheckModule;
use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\CheckSuperAdminRole;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\LanguageChangeMiddleware;
use App\Http\Middleware\MultiTenantMiddleware;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SetLanguage;
use App\Http\Middleware\SetTenantFromUsername;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\XSS;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        TrustProxies::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                   => Authenticate::class,
        'auth.basic'             => AuthenticateWithBasicAuth::class,
        'bindings'               => SubstituteBindings::class,
        'cache.headers'          => SetCacheHeaders::class,
        'can'                    => Authorize::class,
        'guest'                  => RedirectIfAuthenticated::class,
        'password.confirm'       => RequirePassword::class,
        'signed'                 => ValidateSignature::class,
        'throttle'               => ThrottleRequests::class,
        'verified'               => EnsureEmailIsVerified::class,
        'role'                   => RoleMiddleware::class,
        'permission'             => PermissionMiddleware::class,
        'role_or_permission'     => RoleOrPermissionMiddleware::class,
        'xss'                    => XSS::class,
        'checkUserStatus'        => CheckUserStatus::class,
        'modules'                => CheckModule::class,
        'setLanguage'            => SetLanguage::class,
        'languageChangeName'     => LanguageChangeMiddleware::class,
        'multi_tenant'           => MultiTenantMiddleware::class,
        'check_impersonate'      => CheckImpersonateUser::class,
        'setTenantFromUsername'  => SetTenantFromUsername::class,
        'check_super_admin_role' => CheckSuperAdminRole::class,
        'check_subscription'     => CheckSubscription::class,
        'check_menu_access'      => CheckMenuAccess::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        StartSession::class,
        ShareErrorsFromSession::class,
        Authenticate::class,
        ThrottleRequests::class,
        AuthenticateSession::class,
        SubstituteBindings::class,
        Authorize::class,
    ];
}
