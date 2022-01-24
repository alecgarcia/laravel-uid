<?php

namespace Tests;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Base;
use Tests\Models\User;

abstract class TestCase extends Base
{
    protected function setUp(): void
    {
        parent::setUp();

        $config = require __DIR__.'/config/database.php';

        $db = new DB();
        $db->addConnection($config[getenv('DATABASE') ?: 'sqlite']);
        $db->setAsGlobal();
        $db->bootEloquent();

        DB::schema()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 32)->unique();
            $table->string('name');
        });

        DB::schema()->create('user_overrides', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 32)->unique();
            $table->string('name');
        });
    }
}
