<?php

namespace Tests\Models;

use Alecgarcia\LaravelUid\Traits\Uid;

class UserOverride extends Model
{
    use Uid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public static string $uidPrefix = 'usr';
    public static int $uidLength = 10;
    public static bool $uidCheck = false;
    public static string $uidPrefixSeparator = '=';
}
