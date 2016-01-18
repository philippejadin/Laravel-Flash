<?php

namespace DraperStudio\Flash;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'flash';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishConfig()
             ->publishViews()
             ->loadViews()
             ->mergeConfig('flash');
    }

    public function register()
    {
        $this->app->singleton('flash', function () {
            return $this->app->make(FlashNotifier::class);
        });
    }

    public function provides()
    {
        return ['flash'];
    }
}
