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
            $query->uid = LaravelUid::makeForModel(self::uidPrefix(), self::uidLength(), self::uidCheck(), self::class);
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
     * Check to see if length has been set for the uid
     *
     * @return int
     */
    protected static function uidLength()
    {
        return self::$uidLength ?? 16;
    }

    /**
     * Check to see if the uid should be checked
     *
     * @return bool
     */
    protected static function uidCheck()
    {
        return self::$uidCheck ?? true;
    }

    /**
     * @param string $uid
     * @return static
     */
    public static function findByUid($uid)
    {
        return static::where('uid', '=', $uid)->get()->first();
    }
}
