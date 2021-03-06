<?php

namespace Tests\Models;

use Alecgarcia\LaravelUid\Traits\Uid;

class User extends Model
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
}
