<?php

use App\Models\BloodBank;
use App\Models\Department;
use App\Models\DoctorDepartment;
use App\Models\FrontSetting;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\SuperAdminSetting;
use App\Models\User;
use App\Models\VaccinatedPatients;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Stripe\Stripe;

/**
 * @return int
 */
function getLoggedInUserId()
{
    return Auth::id();
}

/**
 * @return User
 */
function getLoggedInUser()
{
    return Auth::user();
}

/**
 * return avatar url.
 *
 * @return string
 */
function getAvatarUrl()
{
    return '//ui-avatars.com/api/';
}

/**
 * return avatar full url.
 *
 * @param int $userId
 * @param string $name
 *
 * @return string
 */
function getUserImageInitial($userId, $name)
{
    return getAvatarUrl()."?name=$name&size=100&rounded=true&color=fff&background=".getRandomColor($userId);
}

/**
 * return random color.
 *
 * @param int $userId
 *
 * @return string
 */
function getRandomColor($userId)
{
    $colors = ['329af0', 'fc6369', 'ffaa2e', '42c9af', '7d68f0'];
    $index = $userId % 5;

    return $colors[$index];
}

/**
 * @param $number
 *
 * @return string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
}

/**
 * @param User $user
 * @param string $image
 *
 * @throws DiskDoesNotExist
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 *
 * @return mixed
 */
function storeProfileImage($user, $image)
{
    $mediaId = $user->addMedia($image)
        ->toMediaCollection(User::COLLECTION_PROFILE_PICTURES, config('app.media_disc'))->id;

    return $mediaId;
}

/**
 * @param User $user
 * @param string $attachment
 *
 * @throws DiskDoesNotExist
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 *
 * @return mixed
 */
function storeAttachments($user, $attachment)
{
    $media = $user->addMedia($attachment)
        ->toMediaCollection(User::COLLECTION_MAIL_ATTACHMENTS, config('app.media_disc'));

    return $media;
}

/**
 * @param User $user
 * @param string $image
 *
 * @throws DiskDoesNotExist
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 *
 * @return mixed
 */
function updateProfileImage($user, $image)
{
    $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
    $mediaId = $user->addMedia($image)
        ->toMediaCollection(User::COLLECTION_PROFILE_PICTURES, config('app.media_disc'))->id;

    return $mediaId;
}

function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first();
    }

    return $appLogo->logo_url;
}

/**
 * @return Department
 */
function getDepartments()
{
    /** @var Department $departments */
    $departments = Department::all()->pluck('name', 'id');

    return $departments;
}

/**
 * @return DoctorDepartment
 */
function getDoctorsDepartments()
{
    /** @var DoctorDepartment $doctorDepartments */
    $doctorDepartments = DoctorDepartment::all()->pluck('title', 'id')->sort();

    return $doctorDepartments;
}

/**
 * @return mixed
 */
function getAppName()
{
    static $appName;

    if (empty($appName)) {
        $appName = Setting::where('key', '=', 'app_name')->first()->value;
    }

    return $appName;
}

/**
 * @param array $models
 * @param string $columnName
 * @param int $id
 *
 * @return bool
 */
function canDelete($models, $columnName, $id)
{
    foreach ($models as $model) {
        $result = $model::where($columnName, $id)->exists();
        if ($result) {
            return true;
        }
    }

    return false;
}

/*
 * @return mixed
 */
function getCompanyName()
{
    $companyName = Setting::where('key', '=', 'company_name')->first()->value;

    return $companyName;
}

/**
 * @param $model
 * @param string $columnName
 * @param int $id
 *
 * @return bool
 */
function canDeletePayroll($model, $columnName, $id)
{
    $result = $model::where($columnName, $id)->exists();
    if ($result) {
        return true;
    }

    return false;
}

/**
 * @return array
 */
function getBloodGroups()
{
    return BloodBank::orderBy('blood_group')->pluck('blood_group', 'blood_group')->toArray();
}

/**
 * @param string|null $currency
 *
 * @return string
 */
function getCurrenciesClass($currency = null)
{
    static $defaultCurrency;

    if (empty($defaultCurrency)) {
        if (!$currency) {
            $defaultCurrency = Setting::where('key', 'current_currency')->first()->value;
        }
    }

    switch ($defaultCurrency) {
        case 'inr':
            return 'fas fa-rupee-sign';
        case 'aud':
            return 'fas fa-dollar-sign';
        case 'usd':
            return 'fas fa-dollar-sign';
        case 'eur':
            return 'fas fa-euro-sign';
        case 'jpy':
            return 'fas fa-yen-sign';
        case 'gbp':
            return 'fas fa-pound-sign';
        case 'cad':
            return 'fas fa-dollar-sign';
        default:
            return 'fas fa-dollar-sign';

    }
}

/**
 * @param string|null $currency
 *
 * @return string
 */
function getCurrenciesForSetting($currency = null)
{
    if (!$currency) {
        $defaultCurrency = Setting::where('key', 'current_currency')->first()->value;
    }

    switch ($currency) {
        case 'inr':
            return 'fas fa-rupee-sign';
        case 'aud':
            return 'fas fa-dollar-sign';
        case 'usd':
            return 'fas fa-dollar-sign';
        case 'eur':
            return 'fas fa-euro-sign';
        case 'jpy':
            return 'fas fa-yen-sign';
        case 'gbp':
            return 'fas fa-pound-sign';
        case 'cad':
            return 'fas fa-dollar-sign';
        default:
            return 'fas fa-dollar-sign';
    }
}

/**
 * @param string|null $currency
 *
 * @return string
 */
function getCurrencyForPDF($currency = null)
{
    if (!$currency) {
        $currency = Setting::where('key', 'current_currency')->first()->value;
    }

    switch ($currency) {
        case 'inr':
            return 8377;
        case 'aud':
            return 36;
        case 'usd':
            return 36;
        case 'eur':
            return 8364;
        case 'jpy':
            return 165;
        case 'gbp':
            return 163;
        case 'cad':
            return 36;
    }
}

/**
 * @return mixed
 */
function getCurrentCurrency()
{
    /** @var Setting $currentCurrency */
    static $currentCurrency;

    if (empty($currentCurrency)) {
        $currentCurrency = Setting::where('key', 'current_currency')->first();
    }

    return $currentCurrency->value;
}

//total-Amount Invoice
/**
 *
 */
function totalAmount(){
    $totalSum = 0;
    $amount = Invoice::get();

    foreach ($amount as $amounts){
        $total = 0;
        if($amounts['discount'] != 0){
            $total += $amounts['amount'] - ($amounts['amount'] * $amounts['discount'] / 100);
        }
        else{
            $totalSum += $amounts['amount'];
        }

        $totalSum += $total;
    }

    return $totalSum;
}
// number formatted code

/**
 * @param $currencyValue
 *
 * @return string
 */
function formatCurrency($currencyValue)
{
    $amountValue = $currencyValue;
    $currencySuffix = ''; //thousand,lac, crore
    $numberOfDigits = countDigit(round($amountValue)); //this is call :)
    if ($numberOfDigits > 3) {
        if ($numberOfDigits % 2 != 0) {
            $divider = divider($numberOfDigits - 1);
        } else {
            $divider = divider($numberOfDigits);
        }
    } else {
        $divider = 1;
    }

    $formattedAmount = $amountValue / $divider;
    $formattedAmount = number_format($formattedAmount, 2);
    if ($numberOfDigits == 4 || $numberOfDigits == 5) {
        $currencySuffix = 'k';
    }
    if ($numberOfDigits == 6 || $numberOfDigits == 7) {
        $currencySuffix = 'Lac';
    }
    if ($numberOfDigits == 8 || $numberOfDigits == 9) {
        $currencySuffix = 'Cr';
    }

    return $formattedAmount.' '.$currencySuffix;
}

/**
 * @param $amount
 *
 * @return int|string
 */
function convertCurrency($amount)
{
    // Convert Price to Crores or Millions or Thousands
    $length = strlen(round($amount));

    if (empty($amount)) {
        return 0;
    }

    if ($length == 4 || $length == 5 || $length == 6) {
        // Thousand
        $amount = $amount / 1000;
        $amount = round($amount, 2);
        $currency = $amount." ".'K';
    } elseif ($length == 7) {
        // Millions
        $amount = $amount / 1000000;
        $amount = round($amount, 2);
        $currency = $amount." ".'M';

    } elseif ($length == 8 || $length == 9) {
        // Crores
        $amount = $amount / 10000000;
        $amount = round($amount, 2);
        $currency = $amount.' '.'Cr';
    } else {
        $currency = $amount;
    }

    return $currency;
}

/**
 * @param $number
 *
 * @return int
 */
function countDigit($number)
{
    return strlen($number);
}

/**
 * @param $numberOfDigits
 *
 * @return int|string
 */
function divider($numberOfDigits)
{
    $tens = '1';
    if ($numberOfDigits > 8) {
        return 10000000;
    }

    while (($numberOfDigits - 1) > 0) {
        $tens .= '0';
        $numberOfDigits--;
    }

    return $tens;
}

/**
 * @param array $input
 * @param string $key
 *
 * @return string|null
 */
function preparePhoneNumber($input, $key)
{
    return (!empty($input[$key])) ? '+'.$input['prefix_code'].$input[$key] : null;
}

/**
 * @param $doctorDepartmentId
 *
 * @return mixed
 */
function getDoctorDepartment($doctorDepartmentId)
{
    return DoctorDepartment::where('id', $doctorDepartmentId)->value('title');
}

/**
 * @param $userOwnerId
 *
 * @return Collection
 */
function getPatientsList($userOwnerId)
{
    $patientCase = PatientCase::with('patient.user')->where('doctor_id', '=',
        $userOwnerId)->where('status', '=', 1)->get()->pluck('patient.user_id', 'id');

    $patientAdmission = PatientAdmission::with('patient.user')->where('doctor_id', '=',
        $userOwnerId)->where('status', '=', 1)->get()->pluck('patient.user_id', 'id');

    $arrayMerge = array_merge($patientAdmission->toArray(), $patientCase->toArray());
    $patientIds = array_unique($arrayMerge);

    $patients = Patient::with('user')->whereIn('user_id', $patientIds)
        ->whereHas('user', function (Builder $query) {
            $query->where('status', 1);
        })->get()->pluck('user.full_name', 'id');

    return $patients;
}

/**
 * @return array
 */
function getCurrencies()
{
    $currencyPath = file_get_contents(storage_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true);
    $currencies = [];

    foreach ($currenciesData['currencies'] as $currency) {
        $convertCode = strtolower($currency['code']);
        $currencies[$convertCode] = [
            'symbol' => $currency['symbol'],
            'name'   => $currency['name'],
        ];
    }

    return $currencies;
}

/**
 * @return mixed
 */
function getCurrencySymbol()
{
    $currencyPath = file_get_contents(storage_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true)['currencies'];

    $currencySymbol = collect($currenciesData)->where('code',
        strtoupper(getCurrentCurrency()))->pluck('symbol')->first();

    return $currencySymbol;
}

/**
 *
 * @return array
 */
function getSettingValue()
{
    return Setting::all()->keyBy('key');
}

/**
 *
 * @return array
 */
function getSuperAdminSettingValue()
{
    return SuperAdminSetting::all()->keyBy('key');
}

/**
 * @param $type
 *
 * @param $key
 *
 * @return mixed
 */
function getFrontSettingValue($type, $key)
{
    return FrontSetting::whereType($type)->where('key', $key)->value('value');
}

function setStripeApiKey()
{
    Stripe::setApiKey(config('services.stripe.secret_key'));
}

/**
 * @param $fileName
 * @param $attachment
 *
 * @return string
 */
function getFileName($fileName, $attachment)
{
    $fileNameExtension = $attachment->getClientOriginalExtension();

    $newName = $fileName.'-'.time();

    return $newName.'.'.$fileNameExtension;
}

/**
 * @param array $data
 */
function addNotification($data)
{
    $notificationRecord = [
        'type'             => $data[0],
        'user_id'          => $data[1],
        'notification_for' => $data[2],
        'title'            => $data[3],
    ];

    if ($user = User::find($data[1])) {
        Notification::create($notificationRecord);
    }
}

/**
 * @param array $role
 *
 * @return Notification[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
 */
function getNotification($role)
{
    return Notification::whereUserId(Auth::id())->whereNotificationFor(Notification::NOTIFICATION_FOR[$role])->where('read_at',
        null)->orderByDesc('created_at')->toBase()->get();
}

/**
 * @param array $data
 *
 * @return array
 */
function getAllNotificationUser($data)
{
    return array_filter($data, function ($key) {
        return $key != getLoggedInUserId();
    }, ARRAY_FILTER_USE_KEY);
}

/**
 * @param array $notificationFor
 *
 * @return string
 */
function getNotificationIcon($notificationFor)
{
    switch ($notificationFor) {
        case 1:
            return 'fas fa-calendar-check';
        case 2:
            return 'fas fa-file-invoice';
        case 3:
            return 'fa fa-rupee-sign';
        case 7:
        case 4:
            return 'fas fa-notes-medical';
        case 5:
            return 'fas fa-stethoscope';
        case 8:
        case 6:
            return 'fas fa-prescription';
        case 9:
            return 'fas fa-diagnoses';
        case 10:
            return 'fas fa-chart-pie';
        case 11:
            return 'fas fa-money-bill-wave';
        case 12:
            return 'fas fa-user-injured';
        case 13:
            return 'fa fa-briefcase-medical';
        case 14:
            return 'fa fa-users';
        case 15:
            return 'fa fa-clipboard';
        case 16:
            return 'fas fa-user-plus';
        case 17:
            return 'fas fa-ambulance';
        case 18:
            return 'fas fa-box';
        case 19:
            return 'fas fa-wallet';
        case 20:
            return 'fas fa-money-check';
        case 21:
            return 'fa fa-video';
        case 22:
            return 'fa fa-file-video';
        default:
            return 'fa fa-inbox';
    }
}

/**
 *
 * @return string[]
 */
function getLanguages()
{
    return User::LANGUAGES;
}

/**
 * @return mixed|null
 */
function checkLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    }

    return 'en';
}

/**
 * 
 */
function headerLanguageName()
{
    if (Session::has('languageChangeName')) {
        return Session::get('languageChangeName');
    }

    return 'en';
}
/**
 * @return mixed|null
 */
function getCurrentLanguageName()
{
    return getLanguages()[checkLanguageSession()];
}
/**
 * @return mixed|null
 */
function getHeaderLanguageName()
{
    return getLanguages()[headerLanguageName()];
}

/*
 * @param $input
 *
 * @param  null  $vaccinatedPatient
 * @param  null  $isCreate
 * @return bool
 */
function checkVaccinatePatientValidation($input, $vaccinatedPatient = null, $isCreate = null)
{
    $patients = VaccinatedPatients::where('patient_id', $input['patient_id'])->get();
    $returnValue = false;
    if ($isCreate) {
        if ($input['patient_id'] != $vaccinatedPatient->patient_id) {
            $patients = VaccinatedPatients::where('patient_id', '!=', $vaccinatedPatient->patient_id)->get();
        }
    }

    foreach ($patients as $patient) {
        if ($input['patient_id'] == $patient->patient_id &&
            $input['vaccination_id'] == $patient->vaccination_id &&
            $input['dose_number'] == $patient->dose_number) {
            $returnValue = true;
            break;
        }
    }

    return $returnValue;
}

/**
 * @param $model
 *
 * @param $mediaCollection
 */
function removeFile($model, $mediaCollection)
{
    $model->clearMediaCollection($mediaCollection);
}

function redirectToDashboard(): string
{
    $user = Auth::user();
    if ($user->hasRole('Super Admin')) {
        return 'super-admin/dashboard';
    } else {
        if ($user->hasRole('Admin')) {
            return 'dashboard';
        } elseif ($user->hasRole(['Receptionist'])) {
            return 'appointments';
        } elseif ($user->hasRole(['Doctor', 'Case Manager', 'Lab Technician', 'Pharmacist'])) {
            return 'employee/doctor';
        } elseif ($user->hasRole(['Patient'])) {
            return 'patient/my-cases';
        } elseif ($user->hasRole(['Nurse'])) {
            return 'bed-types';
        } elseif ($user->hasRole(['Accountant'])) {
            return 'accounts';
        } else {
            return 'employee/notice-board';
        }
    }
}

/**
 * @return User
 */
function getUser()
{
    $loggedInUser = getLoggedInUser();
    $user = null;
    if (!empty($loggedInUser) && request()->segment(2) != $loggedInUser->username || empty($loggedInUser)) {
        $uName = null;
        $uName = request()->segment(2);
        $user = User::withoutGlobalScope(new \Stancl\Tenancy\Database\TenantScope())
            ->where('username', $uName)
            ->first();

        if ($user == null) {
            return $loggedInUser;
        }
    } else {
        $user = getLoggedInUser();
    }

    return $user;
}

/**
 * @return array
 */
function getSchedulesTimingSlot()
{
    $period = new CarbonPeriod('00:00', "15 minutes", '24:00'); // for create use 24 hours format later change format
    $slots = [];
    foreach ($period as $item) {
        $slots[$item->format("H:i")] = $item->format("H:i");
    }

    return $slots;
}

/**
 * @param $key
 * @return string
 */
function getSubscriptionPlanCurrencyIcon($key): string
{
    $currencyPath = file_get_contents(storage_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true)['currencies'];
    $currency = collect($currenciesData)->firstWhere('code',
        strtoupper($key));

    return $currency['symbol'];
}

/**
 * @param $key
 * @return string
 */
function getSubscriptionPlanCurrencyCode($key): string
{
    $currencyPath = file_get_contents(storage_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true)['currencies'];
    $currency = collect($currenciesData)->firstWhere('code',
        strtoupper($key));

    return $currency['code'];
}

/**
 * @return array
 */
function zeroDecimalCurrencies()
{
    return [
        'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF',
    ];
}

/**
 * @return array
 */
function getCurrencyFullName(): array
{
    $currencyPath = file_get_contents(storage_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true);
    $currencies = [];

    foreach ($currenciesData['currencies'] as $currency) {
        $convertCode = strtolower($currency['code']);
        $currencies[$convertCode] = $currency['symbol'].' - '.$currency['code'].' '.$currency['name'];
    }

    return $currencies;
}

/**
 * @return mixed
 */
function isSubscriptionAssign()
{
    return Subscription::where('status', Subscription::ACTIVE)->where('user_id', \Auth::user()->id)->first();
}

/**
 * @return array
 */
function isSubscriptionExpired()
{
    $subscription = Subscription::with('subscriptionPlan')
        ->where('status', Subscription::ACTIVE)
        ->where('user_id', getLoggedInUserId())
        ->first();

    if ($subscription && $subscription->isExpired()) {
        return [
            'status'  => true,
            'message' => 'Your current plan is expired, please choose new plan.',
        ];
    }

    if ($subscription == null) {
        return [
            'status'  => true,
            'message' => 'Please choose a plan to continue the service.',
        ];
    }

    $subscriptionEndDate = Carbon::parse($subscription->ends_at);
    $currentDate = Carbon::parse(Carbon::now())->format('Y-m-d');

    $expirationMessage = '';
    $diffInDays = $subscriptionEndDate->diffInDays($currentDate);
    $superAdminSettingValue = getSuperAdminSettingValue();
    if ($diffInDays <= $superAdminSettingValue['plan_expire_notification']['value'] && $diffInDays != 0) {
        $expirationMessage = "Your '{$subscription->subscriptionPlan->name}' is about to expired in {$diffInDays} days.";
    }

    return [
        'status'  => $subscriptionEndDate->diffInDays($currentDate) <= $superAdminSettingValue['plan_expire_notification']['value'],
        'message' => $expirationMessage,
    ];
}

/**
 * @return array
 */
function getPayPalSupportedCurrencies()
{
    return [
        'AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK',
        'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD',
    ];
}

/**
 * This function will be used for getting the specific menu that has being provided in the subscription plan.
 *
 * @param $routeName
 *
 * @return bool
 */
function isFeatureAllowToUse($routeName)
{
    if (getLoggedInUser()->hasRole('Super Admin')) {
        return true;
    }

    $menuAccess = false;
    $authUser = getLoggedInUser();
    if (!$authUser->hasRole('Admin')) {
        $authUser = User::withoutGlobalScope(new \Stancl\Tenancy\Database\TenantScope())
            ->where('tenant_id', $authUser->owner->tenant_id)->first();
    }

    $subscription = Subscription::with('subscriptionPlan.planFeatures')
        ->where('status', Subscription::ACTIVE)
        ->where('user_id', $authUser->id)->first();

    if (!$subscription) {
        return false;
    }

    $subscriptionPlanFeaturesId = $subscription->subscriptionPlan->planFeatures->pluck('feature_id')->toArray();

    $feature = DB::table('features')->whereJsonContains('route->route_name', [$routeName])->first();
    $featureId = $feature->id;
    if ($feature->has_parent != 0) {
        $featureId = $feature->has_parent;
    }

    if ($feature != null && in_array($featureId, $subscriptionPlanFeaturesId)) {
        $menuAccess = true;
    }

    return $menuAccess;
}

/**
 * @return mixed
 */
function getCurrentActiveSubscriptionPlan()
{
    if (!Auth::user()){
        return null;
    }
    return Subscription::where('status', Subscription::ACTIVE)
        ->where('user_id', \Auth::user()->id)
        ->first();
}

/**
 * @param $date
 *
 * @return string
 */
function getParseDate($date)
{
    return Carbon::parse($date);
}


/**
 * @return bool
 */
function isAuth()
{
    return Auth::check() ? true : false;
}

/**
 * @return Builder|Model|object|null
 */
function currentActiveSubscription()
{
    if (!Auth::user()){
        return null;
    }
    return Subscription::with('subscriptionPlan')
        ->where('status', Subscription::ACTIVE)
        ->where('user_id', \Auth::user()->id)
        ->first();
}

/**
 * @param $planIDChosenByUser
 *
 * @return array|void
 */
function getProratedPlanData($planIDChosenByUser)
{
    /** @var SubscriptionPlan $subscriptionPlan */
    $subscriptionPlan = SubscriptionPlan::findOrFail($planIDChosenByUser);
    $newPlanDays = $subscriptionPlan->frequency == SubscriptionPlan::MONTH ? 30 : 365;

    $currentSubscription = currentActiveSubscription();
    $frequency = $subscriptionPlan->frequency == SubscriptionPlan::MONTH ? 'Monthly' : 'Yearly';

    $startsAt = Carbon::now();

    $carbonParseStartAt = Carbon::parse($currentSubscription->starts_at);
    $usedDays = $carbonParseStartAt->copy()->diffInDays($startsAt);
    $totalExtraDays = 0;
    $totalDays = $newPlanDays;

    $endsAt = Carbon::now()->addDays($newPlanDays);

    $startsAt = $startsAt->copy()->format('jS M, Y');
    if ($usedDays <= 0) {
        $startsAt = $carbonParseStartAt->copy()->format('jS M, Y');
    }

    if (!$currentSubscription->isExpired() && !checkIfPlanIsInTrial($currentSubscription)) {
        $amountToPay = 0;

        $currentPlan = $currentSubscription->subscriptionPlan; // TODO: take fields from subscription

        // checking if the current active subscription plan has the same price and frequency in order to process the calculation for the proration
        $planPrice = $currentPlan->price;
        $planFrequency = $currentPlan->frequency;
        if ($planPrice != $currentSubscription->plan_amount || $planFrequency != $currentSubscription->plan_frequency) {
            $planPrice = $currentSubscription->plan_amount;
            $planFrequency = $currentSubscription->plan_frequency;
        }

        $frequencyDays = $planFrequency == SubscriptionPlan::MONTH ? 30 : 365;
        $perDayPrice = round($planPrice / $frequencyDays, 2);

        $remainingBalance = round($planPrice - ($perDayPrice * $usedDays), 2);

        if ($remainingBalance < $subscriptionPlan->price) { // adjust the amount in plan
            $amountToPay = round($subscriptionPlan->price - $remainingBalance, 2);
        } else {
            $endsAt = Carbon::now();
            $perDayPriceOfNewPlan = round($subscriptionPlan->price / $newPlanDays, 2);
            $totalExtraDays = round($remainingBalance / $perDayPriceOfNewPlan);

            $endsAt = $endsAt->copy()->addDays($totalExtraDays);
            $totalDays = $totalExtraDays;
        }

        return [
            'startDate'          => $startsAt,
            'name'             => $subscriptionPlan->name.' / '.$frequency,
            'trialDays'        => $subscriptionPlan->trial_days,
            'remainingBalance' => $remainingBalance,
            'endDate'          => $endsAt->format('jS M, Y'),
            'amountToPay'      => $amountToPay,
            'usedDays'         => $usedDays,
            'totalExtraDays'   => $totalExtraDays,
            'totalDays'        => $totalDays,
        ];
    }


    return [
        'name'             => $subscriptionPlan->name.' / '.$frequency,
        'trialDays'        => $subscriptionPlan->trial_days,
        'startDate'        => $startsAt,
        'endDate'          => $endsAt->format('jS M, Y'),
        'remainingBalance' => 0,
        'amountToPay'      => $subscriptionPlan->price,
        'usedDays'         => $usedDays,
        'totalExtraDays'   => $totalExtraDays,
        'totalDays'        => $totalDays,
    ];
}


/**
 * @return array
 */
function getCurrentPlanDetails()
{
    $currentSubscription = currentActiveSubscription();
    $isExpired = $currentSubscription->isExpired();
    $currentPlan = $currentSubscription->subscriptionPlan;

    if ($currentPlan->price != $currentSubscription->plan_amount) {
        $currentPlan->price = $currentSubscription->plan_amount;
    }

    $startsAt = Carbon::now();
    $totalDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($currentSubscription->ends_at);
    $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
    $remainingDays = $totalDays - $usedDays;

    $frequency = $currentSubscription->plan_frequency == SubscriptionPlan::MONTH ? 'Monthly' : 'Yearly';

    $days = $currentSubscription->plan_frequency == SubscriptionPlan::MONTH ? 30 : 365;

    $perDayPrice = round($currentPlan->price / $days, 2);

    if (checkIfPlanIsInTrial($currentSubscription)) {
        $remainingBalance = 0.00;
        $usedBalance = 0.00;
    } else {
        $remainingBalance = $currentPlan->price - ($perDayPrice * $usedDays);
        $usedBalance = $currentPlan->price - $remainingBalance;
    }

    return [
        'name'             => $currentPlan->name.' / '.$frequency,
        'trialDays'        => $currentPlan->trial_days,
        'startAt'          => Carbon::parse($currentSubscription->starts_at)->format('jS M, Y'),
        'endsAt'           => Carbon::parse($currentSubscription->ends_at)->format('jS M, Y'),
        'usedDays'         => $usedDays,
        'remainingDays'    => $remainingDays,
        'totalDays'        => $totalDays,
        'usedBalance'      => $usedBalance,
        'remainingBalance' => $remainingBalance,
        'isExpired'        => $isExpired,
        'currentPlan'      => $currentPlan,
    ];
}

/**
 * @param Subscription $currentSubscription
 *
 * @return bool
 */
function checkIfPlanIsInTrial($currentSubscription)
{
    $now = Carbon::now();
    if (! empty($currentSubscription->trial_ends_at) && $currentSubscription->trial_ends_at > $now) {
        return true;
    }

    return false;

}

/**
 * @param $menu
 *
 *
 * @return false|string
 */
function getMenuLinks($menu)
{
    //ipd opd routes
    if ($menu == User::MAIN_IPD_OPD) {
        $defaultRoute = route('ipd.patient.index');
        $subMenus = ['IPD Patients', 'OPD Patients'];
    }
    //bed management routes
    if ($menu == User::MAIN_BED_MGT) {
        $defaultRoute = route('bed-assigns.index');
        $subMenus = ['Bed Types', 'Beds', 'Bed Assigns'];
    }
    //billing module
    if ($menu == User::MAIN_BILLING_MGT) {
        $defaultRoute = route('accounts.index');
        $subMenus = [
            'Accounts', 'Employee Payrolls', 'Invoices', 'Payments', 'Payment Reports', 'Advance Payments', 'Bills',
        ];
    }
    //blood bank module
    if ($menu == User::MAIN_BLOOD_BANK_MGT) {
        $defaultRoute = route('blood-banks.index');
        $subMenus = ['Blood Banks', 'Blood Donors', 'Blood Donations', 'Blood Issues'];
    }
    //document module
    if ($menu == User::MAIN_DOCUMENT) {
        $defaultRoute = route('documents.index');
        $subMenus = ['Documents', 'Document Types'];
    }
    //doctor module
    if ($menu == User::MAIN_DOCTOR) {
        $defaultRoute = route('doctors.index');
        $subMenus = ['Doctors', 'Departments', 'Schedules', 'Prescriptions'];
    }
    //diagnosis module
    if ($menu == User::MAIN_DIAGNOSIS) {
        $defaultRoute = route('diagnosis.category.index');
        $subMenus = ['Diagnosis Categories', 'Diagnosis Tests'];
    }
    //finance module
    if ($menu == User::MAIN_FINANCE) {
        $defaultRoute = route('incomes.index');
        $subMenus = ['Income', 'Expense'];
    }
//    Front Office
    if ($menu == User::MAIN_FRONT_OFFICE) {
        $defaultRoute = route('call_logs.index');
        $subMenus = ['Call Logs', 'Visitors', 'Postal', 'Receive', 'Postal', 'Dispatch'];
    }
    // Hospital Charge
    if ($menu == User::MAIN_HOSPITAL_CHARGE) {
        $defaultRoute = route('charge-categories.index');
        $subMenus = ['Charge Categories', 'Charges', 'Doctor OPD Charges'];
    }
    // Inventory
    if ($menu == User::MAIN_INVENTORY) {
        $defaultRoute = route('item-categories.index');
        $subMenus = ['Items Categories', 'Items', 'Item Stocks', 'Issued Items'];
    }
    // live Consolation
    if ($menu == User::MAIN_LIVE_CONSULATION) {
        $defaultRoute = route('live.consultation.index');
        $subMenus = ['Live Consultations', 'Live Meetings'];
    }
    // medicines
    if ($menu == User::MAIN_MEDICINES) {
        $defaultRoute = route('categories.index');
        $subMenus = ['Medicines', 'Medicine Brands', 'Medicine Categories'];
    }
    // patient case
    if ($menu == User::MAIN_PATIENT_CASE) {
        $defaultRoute = route('patients.index');
        $subMenus = ['Patients', 'Cases', 'Case Handlers', 'Patient Admissions'];
    }
    // Pathology
    if ($menu == User::MAIN_PATHOLOGY) {
        $defaultRoute = route('pathology.category.index');
        $subMenus = ['Pathology Categories', 'Pathology Tests'];
    }
    // Report
    if ($menu == User::MAIN_REPORT) {
        $defaultRoute = route('birth-reports.index');
        $subMenus = ['Birth Reports', 'Death Reports', 'Investigation Reports', 'Operation Reports'];
    }
    // Radiology
    if ($menu == User::MAIN_RADIOLOGY) {
        $defaultRoute = route('radiology.category.index');
        $subMenus = ['Radiology Categories', 'Radiology Tests'];
    }
    // Service
    if ($menu == User::MAIN_SERVICE) {
        $defaultRoute = route('insurances.index');
        $subMenus = ['Insurances', 'Packages', 'Services', 'Ambulances', 'Ambulance Calls'];
    }
    // Sms/Mail
    if ($menu == User::MAIN_SMS_MAIL) {
        $defaultRoute = route('sms.index');
        $subMenus = ['SMS', 'Mail'];
    }

    //doctor role bed management routes
    if ($menu == User::MAIN_DOCTOR_BED_MGT) {
        $defaultRoute = route('bed-assigns.index');
        $subMenus = ['Bed Assigns'];
    }
//    document doctore
    if ($menu == User::MAIN_DOCTOR_PATIENT_CASE) {
        $defaultRoute = route('patients.index');
        $subMenus = ['Patient Admissions'];
    }
    if ($menu == User::MAIN_CASE_MANGER_PATIENT_CASE) {
        $defaultRoute = route('patient-cases.index');
        $subMenus = ['Cases', 'Patient Admissions'];
    }
    if ($menu == User::MAIN_CASE_MANGER_SERVICE) {
        $defaultRoute = route('ambulances.index');
        $subMenus = ['Ambulances', 'Ambulance Calls'];
    }
    if ($menu == User::MAIN_ACCOUNT_MANAGER_MGT) {
        $defaultRoute = route('accounts.index');
        $subMenus = ['Accounts', 'Employee Payrolls', 'Invoices', 'Payments', 'Bills'];
    }

    if ($menu == User::MAIN_VACCINATION_MGT) {
        $defaultRoute = route('vaccinated-patients.index');
        $subMenus = ['Vaccinated Patients', 'Vaccinations'];
    }

    $allDisabled = \App\Models\Module::whereIn('name', $subMenus)
        ->where('is_active', true)
        ->get();

    if ($allDisabled->isEmpty()) {
        return false;
    }

    if ($allDisabled->count() != 2) {
        return route($allDisabled->first()->route);
    }

    return $defaultRoute;
}

/**
 * @return mixed
 */
function getSettingForReCaptcha($userName)
{
    $user = User::where('userName', $userName)->first();
    if (!$user) {
        $user = DB::table('users')->where('userName', $userName)->first();
    }
    $isEnabledGoogleCapcha = Setting::where('key', 'enable_google_recaptcha')->where('tenant_id',
        $user->tenant_id)->value('value');

    return $isEnabledGoogleCapcha;
}

/**
 * @return array
 */
function getRazorPaySupportedCurrencies(): array
{
    return [
        'USD', 'EUR', 'GBP', 'SGD', 'AED', 'AUD', 'CAD', 'CNY', 'SEK', 'NZD', 'MXN', 'HKD', 'NOK', 'RUB', 'ALL', 'AMD',
        'ARS', 'AWG', 'BBD', 'BDT', 'BMD', 'BND', 'BOB', 'BSD', 'BWP', 'BZD', 'CHF', 'COP', 'CRC', 'CUP', 'CZK', 'DKK',
        'DOP', 'DZD', 'EGP', 'ETB', 'FJD', 'GIP', 'GMD', 'GTQ', 'GYD', 'HKD', 'HNL', 'HRK', 'HTG', 'HUF', 'IDR', 'ILS',
        'INR', 'JMD', 'KES', 'KGS', 'KHR', 'KYD', 'KZT', 'LAK', 'LBP', 'LKR', 'LRD', 'LSL', 'MAD', 'MDL', 'MKD', 'MMK',
        'MNT', 'MOP', 'MUR', 'MVR', 'MWK', 'MYR', 'NAD', 'NGN', 'NIO', 'NOK', 'NPR', 'PEN', 'PGK', 'PHP', 'PKR', 'QAR',
        'SAR', 'SCR', 'SLL', 'SOS', 'SSP', 'SVC', 'SZL', 'THB', 'TTD', 'TZS', 'UYU', 'UZS', 'YER', 'ZAR', 'GHS',
    ];
}
