<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\URL;

class ForceHttpsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        URL::forceScheme('https');
    }
}
