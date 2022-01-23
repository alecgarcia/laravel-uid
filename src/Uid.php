<?php

namespace Alecgarcia\LaravelUid;

class Uid
{
    const ALPHA_NUM = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Uid::makeR
    // Uid::check

    /**
     * @param  string|null  $prefix
     * @param  int  $length
     *
     * @return string
     */
    public static function make(string $prefix = null, int $length = 16) : string
    {
        $uid = '';

        if ($prefix && strlen($prefix) > 0) {
            $uid = $prefix . '_';
        }

        $prefixLength = strlen($uid);

        for ($i = 0; $i < ($length - $prefixLength); $i++) {
            $index = mt_rand() % strlen(self::ALPHA_NUM);
            $uid .= substr(self::ALPHA_NUM, $index, 1);
        }

        return $uid;
    }
}
