<?php

namespace Pazuzu156\Gravatar\Laravel;

use Illuminate\Support\ServiceProvider;
use Pazuzu156\Gravatar\Gravatar;

/**
 * Gravatar Service Provider.
 */
class GravatarServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../../config.php' => config_path('gravatar.php'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('gravatar', function($app) {
            return new Gravatar(
                config('gravatar.defaults.size'),
                config('gravatar.secure')
            );
        });
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return ['gravatar'];
    }
}
