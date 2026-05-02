<?php

namespace Zhylon\Open\Tests;

use Zhylon\Open\OpenServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            OpenServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('zopen.environments', ['testing']);
    }
}
