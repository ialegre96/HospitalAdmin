<?php

namespace App\Repositories;

use App\Models\Accountant;
use App\Models\AdvancedPayment;
use App\Models\Appointment;
use App\Models\BedAssign;
use App\Models\Bill;
use App\Models\BirthReport;
use App\Models\CaseHandler;
use App\Models\DeathReport;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Models\EmployeePayroll;
use App\Models\InvestigationReport;
use App\Models\Invoice;
use App\Models\IpdPatientDepartment;
use App\Models\LabTechnician;
use App\Models\MultiTenant;
use App\Models\Nurse;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Pharmacist;
use App\Models\Prescription;
use App\Models\Receptionist;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTenant;
use Auth;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 * @version January 11, 2020, 11:09 am UTC
 */
class HospitalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }


    /**
     * @param $input
     *
     * @throws \Throwable
     * @return bool
     */
    public function store($input)
    {
        try {
            $input['password'] = Hash::make($input['password']);
            $input['status'] = User::ACTIVE;
            $input['first_name'] = $input['hospital_name'];

            $adminRole = Department::whereName('Admin')->first();
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['department_id'] = $adminRole->id;
            $input['email_verified_at'] = Carbon::now();
            $user = User::create($input);
            $user->assignRole($adminRole);

            $tenant = MultiTenant::create([
                'tenant_username' => $input['username'], 'hospital_name' => $input['hospital_name'],
            ]);

            $user->update(['tenant_id' => $tenant->id]);

            UserTenant::create([
                'tenant_id'     => $tenant->id,
                'user_id'       => $user->id,
                'last_login_at' => Carbon::now(),
            ]);
            
            $doctorDep = new DoctorDepartment();
            $doctorDep->tenant_id = $tenant->id;
            $doctorDep->title = 'Doctor';
            $doctorDep->saveQuietly();

            /*
            $subscription = [
                'user_id'    => $user->id,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addDays(6),
                'status'     => 1,
            ];
            Subscription::create($subscription);
            */

            // creating settings and assigning the modules to the created user.
            session(['tenant_id' => $tenant->id]);
            Artisan::call('db:seed', ['--class' => 'SettingsTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'AddSocialSettingTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'DefaultModuleSeeder']);
            Artisan::call('db:seed', ['--class' => 'FrontSettingHomeTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'FrontSettingTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'AddAppointmentFrontSettingTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'AddHomePageBoxContentSeeder']);
            Artisan::call('db:seed', ['--class' => 'AddDoctorFrontSettingTableSeeder']);
            Artisan::call('db:seed', ['--class' => 'FrontServiceSeeder']);
            Artisan::call('db:seed', ['--class' => 'GoogleRecaptchaSettingSeeder']);

            // assign the default plan to the user when they registers.
            $subscriptionPlan = SubscriptionPlan::where('is_default', 1)->first();
            $trialDays = $subscriptionPlan->trial_days;
            $subscription = [
                'user_id'              => $user->id,
                'subscription_plan_id' => $subscriptionPlan->id,
                'plan_amount'          => $subscriptionPlan->price,
                'plan_frequency'       => $subscriptionPlan->frequency,
                'starts_at'            => Carbon::now(),
                'ends_at'              => Carbon::now()->addDays($trialDays),
                'trial_ends_at'        => Carbon::now()->addDays($trialDays),
                'status'               => Subscription::ACTIVE,
            ];
            Subscription::create($subscription);


        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param $input
     * @param $user
     * @return bool
     */
    public function updateHospital($input, $user)
    {
        try {
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['first_name'] = $input['hospital_name'];

            $user->update(Arr::except($input, ['username']));
            $userTenant = MultiTenant::find($user->tenant_id);
            $userTenant->hospital_name = $input['hospital_name'];
            $userTenant->save();


        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteHospital($id)
    {
        try {
            /**
             * @var User $user
             */
            $user = User::findOrFail($id);
            $tenant = MultiTenant::where('id', $user->tenant_id);
            $tenant->delete();
            if ($tenant) {
                $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
                $user->delete();
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return Builder[]|null
     */
    public function getUserData($id)
    {
        $data['hospital'] = User::with(['roles', 'hospital'])->findOrFail($id)->append(['gender_string', 'image_url']);
        $data['hospitalUser'] = User::with(['roles'])->where('tenant_id', $data['hospital']->tenant_id)->where('id',
            '!=', $id)->get();
        $data['statusArr'] = User::STATUS_ARR;
        $userRole = ['Admin', 'Super Admin'];
        $data['roles'] = Department::whereNotIn('name', $userRole)->orderBy('name')->pluck('name', 'id')->toArray();
        $data['paymentType'] = Transaction::PAYMENT_TYPES;

        return $data;
    }
}
