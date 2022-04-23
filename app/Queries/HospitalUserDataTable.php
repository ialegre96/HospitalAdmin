<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable
 */
class HospitalUserDataTable
{
    /**
     * @param  array  $input
     *
     * @return User
     */
    public function get($input = [])
    {
        $hospital = User::with('roles')->findOrFail($input['id'])->append(['gender_string', 'image_url']);
        /** @var User $query */
        $query = User::with(['roles', 'department', 'media'])->where('id', '!=', $input['id'])->where('tenant_id',
            $hospital->tenant_id)->select('users.*');

        $query->when(! empty($input['department_id']),
            function (Builder $q) use ($input) {
                $q->where('department_id', $input['department_id']);
            });

        $query->when(isset($input['status']) && $input['status'] != User::STATUS_ARR,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        return $query;
    }
}
