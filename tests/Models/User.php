<?php

namespace Tests\Models;

use Alecgarcia\LaravelUid\Traits\Uid;

class User extends Model
{
    use Uid;

    public static string $uidPrefix = 'usr';
}
