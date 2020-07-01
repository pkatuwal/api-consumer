<?php

namespace Pramod\ApiConsumer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pramod\ApiConsumer\Skeleton\SkeletonClass
 */
class Api extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api';
    }
}
