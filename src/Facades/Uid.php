<?php

namespace Alecgarcia\LaravelUid\Facades;

use Illuminate\Support\Facades\Facade;

class Uid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'uid';
    }
}
