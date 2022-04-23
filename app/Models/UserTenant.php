<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTenant
 */
class UserTenant extends Model
{
    protected $table = 'user_tenants';
    
    protected $fillable = [
        'user_id',  
        'tenant_id',  
        'last_login_at',  
    ];
}
