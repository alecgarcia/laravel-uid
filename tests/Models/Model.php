<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Model as Base;

abstract class Model extends Base
{

    public $timestamps = false;

    public static function hello() {
        return 'hello';
    }
}
