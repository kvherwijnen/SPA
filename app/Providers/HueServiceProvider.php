<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HueServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // If we do not disable the routes, load in the roads & views.
        if (config('services.philips-hue.routes', true)) {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
            $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'hue');
        }
    }
}
