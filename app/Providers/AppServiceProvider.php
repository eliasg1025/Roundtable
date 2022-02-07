<?php

namespace App\Providers;

use App\User;
use App\Observers\UserObserver;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
			$this->app['request']->server->set('HTTPS', true);
		}
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Schema::defaultStringLength(191);
		User::Observe(UserObserver::class);

		if (env('REDIRECT_HTTPS')) {
			$url->formatScheme('https://');
		}
    }
}
