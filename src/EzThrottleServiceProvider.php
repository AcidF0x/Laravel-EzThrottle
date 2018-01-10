<?php

namespace AcidF0x\EzThrottle;

use Illuminate\Support\ServiceProvider;

class EzThrottleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'ezthrottle');
        
        $this->publishes([
            __DIR__.'/Lang' => resource_path('lang/vendor/ezthrottle'),
            __DIR__.'/Config/ezthrottle.php' =>  config_path('ezthrottle.php')
        ]);
    }
}