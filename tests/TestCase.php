<?php

namespace Pramod\ApiConsumer\Tests;

use Pramod\ApiConsumer\ApiConsumerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [ApiConsumerServiceProvider::class];
    }
}
