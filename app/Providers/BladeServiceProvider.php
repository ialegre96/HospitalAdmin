<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class BladeServiceProvider
 */
class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('show', function ($record) {
            $data = explode('.', $record);

            $var = array_shift($data); // take variable into $var
            $properties = array_values($data);

            if (count($properties) > 1) { // if nested properties are passed
                $prop1 = $properties[0];
                $prop2 = $properties[1];

                return "<?php 
                 
                 if(!empty(($$var)->$prop1) && !empty(($$var)->$prop1)) {
                      echo ($$var)->$prop1->$prop2;
                 } else {
                     echo 'N/A'; 
                 }
                  ?>";
            }

            $prop = $properties[0]; // if there is only one property

            return "<?php 
                 
                 if(!empty(($$var)->$prop))) {
                     echo ($$var)->$prop;
                 } else {
                    echo 'N/A';
                 }
                 
                 ?>";
        });
    }
}
