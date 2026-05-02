<?php

namespace Zhylon\Open;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Zhylon\Open\Http\Middleware\InjectOpenComment;

class OpenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/zopen.php',
            'zopen'
        );
    }

    public function boot(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerMiddleware();
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__.'/../config/zopen.php' => config_path('zopen.php'),
        ], 'open-config');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'zopen');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/zopen'),
        ], 'zopen-views');
    }

    protected function registerMiddleware(): void
    {
        if (! $this->isActiveEnvironment()) {
            return;
        }

        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(InjectOpenComment::class);
    }

    protected function isActiveEnvironment(): bool
    {
        $environments = config('zopen.environments', ['production']);

        return $this->app->environment($environments);
    }
}
