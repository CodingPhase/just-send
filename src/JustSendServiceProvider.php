<?php

namespace CodingPhase\JustSend;

use Illuminate\Support\ServiceProvider;

class JustSendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(JustSendChannel::class)
            ->needs(JustSend::class)
            ->give(function () {
                $config = config('services.justSend');

                return new JustSend(
                    $config['key'],
                    $config['url'],
                    $config['type'],
                    $config['from']
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
