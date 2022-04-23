<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable
 */
class UserDataTable
{
    /**
     * @param  array  $input
     *
     * @return User
     */
    public function get($input = [])
    {
        /** @var User $query */
        $query = User::with(['department', 'media'])->where('id', '!=', getLoggedInUserId())->select('users.*');

        if (getLoggedInUser()->hasRole('Super Admin')) {
            $query->where('department_id', '=', User::USER_ADMIN)->whereNotNull('hospital_name');
        }

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
