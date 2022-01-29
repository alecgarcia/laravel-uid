<?php

namespace Tests\Models;

use Alecgarcia\LaravelUid\Traits\Uid;

class UserOverrideColumnConfig extends Model
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

    public static int $uidLength = 32;
}
