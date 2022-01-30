<?php

namespace Alecgarcia\LaravelUid\Traits;

use Illuminate\Support\Str;
use Alecgarcia\LaravelUid\Uid as LaravelUid;

trait Uid
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->{self::uidColumn()} = LaravelUid::makeForModel(
                self::uidPrefix(),
                self::uidLength(),
                self::uidPrefixSeparator(),
                self::uidCheck(),
                self::class
            );
        });
    }

    /**
     * Check to see if prefix has been set for the uid
     *
     * @return null
     */
    protected static function uidPrefix()
    {
        return self::$uidPrefix ?? Str::lower(class_basename(self::class));
    }

    /**
     * Check to see if prefix separator has been set for the uid
     *
     * @return int
     */
    protected static function uidPrefixSeparator()
    {
        return self::$uidPrefixSeparator ?? config('laravel-uid.prefix_separator', '_');
    }

    /**
     * Check to see if length has been set for the uid
     *
     * @return int
     */
    protected static function uidLength()
    {
        return self::$uidLength ?? config('laravel-uid.length', 16);
    }

    /**
     * Check to see if the uid should be checked
     *
     * @return bool
     */
    protected static function uidCheck()
    {
        return self::$uidCheck ?? config('laravel-uid.check', true);
    }

    /**
     * Check to see if prefix has been set for the uid
     *
     * @return null
     */
    protected static function uidColumn()
    {
        return self::$uidColumn ?? config('laravel-uid.uid_column', 'uid');
    }

    /**
     * @param string $uid
     * @return static
     */
    public static function findByUid($uid)
    {
        return static::where(self::uidColumn(), '=', $uid)->get()->first();
    }
}
