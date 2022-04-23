<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Class SaveTenantID
 */
trait PopulateTenantID
{
    protected static function booted()
    {
        if (Auth::check()) {
            static::saving(function ($modal) {
                $modal->tenant_id = Auth::user()->tenant_id;
            });
        } else {
            static::saving(function ($modal) {
                $modal->tenant_id = $modal->tenant_id;
            });
        }
    }
}
