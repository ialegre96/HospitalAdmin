<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
{
    /**
     * Listen to the Setting updated event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        Setting::flushQueryCache();
    }

    /**
     * Listen to the Setting created event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        Setting::flushQueryCache();
    }

}
