<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $host = Config::get('app.url');
        Log::info('===============================');
        Log::info('Listening on', ['host' => sprintf($host)]);
        Log::info('Docs addr', ['addr' => sprintf('%s/swagger-ui/index.html', $host)]);
        Log::info('===============================');
    }
}
