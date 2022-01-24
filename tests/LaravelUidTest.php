<?php

namespace Tests;

use Alecgarcia\LaravelUid\Uid;
use Illuminate\Support\Str;
use Tests\Models\User;
use Tests\Models\UserOverride;

class LaravelUidTest extends TestCase
{
    /** @test */
    public function can_generate_uid()
    {
        $uid = Uid::make('prefix', 16);
        $this->assertNotNull($uid);
        $this->assertIsString($uid);
    }

    /** @test */
    public function uid_length_changes()
    {
        $uid = Uid::make('prefix', 10);
        $this->assertEquals(10, strlen($uid));

        $uid = Uid::make('prefix', 24);
        $this->assertEquals(24, strlen($uid));
    }

    /** @test */
    public function uid_can_have_a_prefix()
    {
        $uid = Uid::make('prefix', 17);
        $this->assertStringContainsString('prefix_', $uid);
    }

    /** @test */
    public function uid_does_not_need_a_prefix()
    {
        $uid = Uid::make('', 17);
        $this->assertEquals(17, strlen($uid));
    }

    /** @test */
    public function uid_is_created_with_model_trait()
    {
        $user = User::create(['name' => 'First Last']);
        $this->assertStringContainsString('user_', $user->uid);
    }

    /** @test */
    public function uid_trait_prefix_can_be_changed()
    {
        $user = UserOverride::create(['name' => 'First Last']);
        $this->assertStringContainsString('usr_', $user->uid);
    }

    /** @test */
    public function uid_trait_length_can_be_changed()
    {
        $user = UserOverride::create(['name' => 'First Last']);
        $this->assertEquals(10, strlen($user->uid));
    }

    /** @test */
    public function can_find_instance_using_findByUid()
    {
        $user = User::create(['name' => 'First Last']);
        User::create(['name' => 'Wrong Person']);
        $foundUser = User::findByUid($user->uid);

        $this->assertTrue($user->is($foundUser));
    }
}
