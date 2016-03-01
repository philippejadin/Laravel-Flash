<?php

/*
 * This file is part of Laravel Flash.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Flash;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends BaseProvider
{
    /**
     * @var string
     */
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

    /**
     * @return array
     */
    public function provides()
    {
        return ['flash'];
    }
}
