<?php

namespace App\Http\Controllers;

use App\Models\MultiTenant;
use App\Models\UserTenant;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class TenantController
 */
class TenantController extends AppBaseController
{
    public function switchWorkspace($tenantID)
    {
        MultiTenant::findOrFail($tenantID);
        $tenant = UserTenant::where('tenant_id', $tenantID)->where('user_id', Auth::id())->first();

        if ($tenant) {
            $tenant->update(['last_login_at' => Carbon::now()]);
            Auth::user()->update(['tenant_id' => $tenantID]);
            
            return redirect(redirectToDashboard());
        }
        
        return redirect()->back();
    }

    public function assignNewWorkspace(Request $request): \Illuminate\Http\JsonResponse
    {
        $tenantID = $request->get('tenant_id');
        
        MultiTenant::findOrFail($tenantID);
        $exist = UserTenant::where('tenant_id', $tenantID)->where('user_id', Auth::id())->exists();

        if (!$exist) {
            UserTenant::create([
                'tenant_id'     => $tenantID,
                'user_id'       => Auth::id(),
                'last_login_at' => Carbon::now(),
            ]);
        }
        
        return $this->sendSuccess('New tenant assigned successfully');
    }
}
