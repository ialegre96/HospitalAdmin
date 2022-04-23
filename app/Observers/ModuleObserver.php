<?php

namespace App\Observers;

use App\Models\Module;

class ModuleObserver
{
    /**
     * Listen to the Module updated event.
     *
     * @param  Module  $module
     * @return void
     */
    public function updated(Module $module)
    {
        Module::flushQueryCache();
    }

    /**
     * Listen to the Module created event.
     *
     * @param  Module  $module
     * @return void
     */
    public function created(Module $module)
    {
        Module::flushQueryCache();
    }

}
