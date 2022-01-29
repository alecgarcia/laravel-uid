<?php

namespace Alecgarcia\LaravelUid;

class Uid
{
    const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @param  string|null  $prefix
     * @param  int|null  $length
     *
     * @return string
     */
    public static function make(string $prefix = null, int $length = null) : string
    {
        $characters = config('laravel-uid.characters', self::CHARACTERS);
        $length = !is_null($length) ? $length : config('laravel-uid.length', 16);
        $uid = '';

        if ($prefix && strlen($prefix) > 0) {
            $uid = $prefix . config('laravel-uid.prefix_separator', '_');
        }

        $prefixLength = strlen($uid);

        for ($i = 0; $i < ($length - $prefixLength); $i++) {
            $index = mt_rand() % strlen($characters);
            $uid .= substr($characters, $index, 1);
        }

        return $uid;
    }

    /**
     * @param  string|null  $prefix
     * @param  int  $length
     * @param  bool  $checkIfExists
     * @param  null  $model
     *
     * @return string
     */
    public static function makeForModel(string $prefix = null, int $length = 16, bool $checkIfExists = false, $model = null) : string
    {
        do {
            $uid = self::make($prefix, $length);
        } while ($checkIfExists && $model::findByUid($uid));

        return $uid;
    }
}
