<?php

namespace Alecgarcia\LaravelUid\Traits;

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
            $query->uid = LaravelUid::makeForModel(self::uidPrefix(), self::uidLength(), self::uidCheck(), self::uidModel());
        });
    }

    /**
     * Check to see if prefix has been set for the uid
     *
     * @return null
     */
    protected static function uidPrefix()
    {
        return isset(self::$uidPrefix) ? self::$uidPrefix : null;
    }

    /**
     * Check to see if length has been set for the uid
     *
     * @return int
     */
    protected static function uidLength()
    {
        return isset(self::$uidLength) ? self::$uidLength : 16;
    }

    /**
     * Check to see if the uid should be checked
     *
     * @return bool
     */
    protected static function uidCheck()
    {
        return isset(self::$uidCheck) ? self::$uidCheck : true;
    }

    /**
     * Check to see if a different model has been set to check
     *
     * @return class
     */
    protected static function uidModel()
    {
        return isset(self::$uidModel) ? self::$uidModel : self::class;
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
