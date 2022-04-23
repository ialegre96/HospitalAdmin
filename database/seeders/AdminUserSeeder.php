<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Department::whereName('Super Admin')->first();

        $input = [
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => 'admin@hms.com',
            'password'          => Hash::make('123456789'),
            'phone'             => '7878454512',
            'gender'            => 1,
            'dob'               => '1994-12-12',
            'blood_group'       => 'B+',
            'status'            => 1,
            'email_verified_at' => Carbon::now(),
            'department_id'     => $adminRole->id,
        ];

        $user = User::create($input);
        $user->assignRole($adminRole);
    }
}
