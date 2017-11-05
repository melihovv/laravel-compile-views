<?php

declare(strict_types = 1);

namespace Melihovv\LaravelCompileViews;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ViewCompileCommand::class,
            ]);
        }
    }
}
