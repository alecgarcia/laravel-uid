<?php

namespace Alecgarcia\LaravelUid\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelUid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-uid';
    }
}
