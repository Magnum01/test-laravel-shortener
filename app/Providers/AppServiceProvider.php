<?php

namespace App\Providers;

use App\Http\Services\Link\LinkShortener;
use App\Http\Services\Link\RandomLinkShortener;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LinkShortener::class, function() {
            return $this->app->get(RandomLinkShortener::class);
        });
    }

    public function boot()
    {
        //
    }
}
