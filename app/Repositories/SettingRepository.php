<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\SuperAdminSetting;
use Arr;
use Carbon\Carbon;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\Exceptions\MediaCannotBeDeleted;

/**
 * Class SettingRepository
 * @version February 19, 2020, 1:45 pm UTC
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_name',
        'app_logo',
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
        return Setting::class;
    }

    public function getSyncList()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function getSyncListForSuperAdmin()
    {
        return SuperAdminSetting::pluck('value', 'key')->toArray();
    }

    /**
     * @param  array  $input
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws MediaCannotBeDeleted
     */
    public function updateSetting($input)
    {
        if (isset($input['app_logo']) && !empty($input['app_logo'])) {
            /** @var Setting $setting */
            $setting = Setting::where('key', '=', 'app_logo')->first();
            $setting->clearMediaCollection(Setting::PATH);
            $setting->addMedia($input['app_logo'])->toMediaCollection(Setting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }
        if (isset($input['favicon']) && ! empty($input['favicon'])) {
            /** @var Setting $setting */
            $setting = Setting::where('key', '=', 'favicon')->first();
            $setting->clearMediaCollection(Setting::PATH);
            $setting->addMedia($input['favicon'])->toMediaCollection(Setting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }

        $input['hospital_phone'] = preparePhoneNumber($input, 'hospital_phone');
        $loggingUserSetting = Setting::where('key', 'enable_google_recaptcha')->exists();
        if (! $loggingUserSetting) {
            $userSettings = [
                'key'        => 'enable_google_recaptcha', 'value' => 0,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
                'tenant_id'  => getLoggedInUser()->tenant_id,
            ];
            Setting::insert($userSettings);
        } else {
            $input['enable_google_recaptcha'] = (! isset($input['enable_google_recaptcha'])) ? false : $input['enable_google_recaptcha'];
        }

        $settingInputArray = Arr::only($input, [
            'app_name', 'company_name', 'hospital_email', 'hospital_phone', 'hospital_from_day', 'hospital_from_time',
            'hospital_address', 'current_currency', 'facebook_url', 'twitter_url', 'instagram_url', 'linkedIn_url',
            'about_us', 'enable_google_recaptcha',
        ]);
        foreach ($settingInputArray as $key => $value) {
            Setting::where('key', '=', $key)->first()->update(['value' => $value]);
        }
    }

    /**
     * @param  array  $input
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws MediaCannotBeDeleted
     */
    public function updateSuperAdminSetting($input)
    {
        $setting = SuperAdminSetting::where('key', '=', 'app_name')->first();
        $settingExpireNotification = SuperAdminSetting::where('key', '=', 'plan_expire_notification')->first();
        $settingExpireNotification->update(['value' => $input['plan_expire_notification']]);
        $setting->update(['value' => $input['app_name']]);

        if (isset($input['app_logo']) && ! empty($input['app_logo'])) {
            /** @var SuperAdminSetting $setting */
            $setting = SuperAdminSetting::where('key', '=', 'app_logo')->first();
            $setting->clearMediaCollection(SuperAdminSetting::PATH);
            $setting->addMedia($input['app_logo'])->toMediaCollection(SuperAdminSetting::PATH,
                config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }
        if (isset($input['favicon']) && ! empty($input['favicon'])) {
            /** @var SuperAdminSetting $setting */
            $setting = SuperAdminSetting::where('key', '=', 'favicon')->first();
            $setting->clearMediaCollection(SuperAdminSetting::PATH);
            $setting->addMedia($input['favicon'])->toMediaCollection(SuperAdminSetting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }
    }

    /**
     * @param  array  $input
     */
    public function updateSuperFooterAdminSetting($input)
    {
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $inputArray = Arr::only($input, [
            'footer_text', 'email', 'phone', 'address', 'facebook_url', 'twitter_url',
            'instagram_url', 'linkedin_url',
        ]);
        foreach ($inputArray as $key => $value) {

            $setting = SuperAdminSetting::where('key', '=', $key)->first();
            $setting->update(['value' => $value]);
        }

        return $setting;
    }
}
