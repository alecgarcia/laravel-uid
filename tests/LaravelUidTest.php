<?php

namespace Tests;

use Alecgarcia\LaravelUid\Uid;
use Illuminate\Support\Str;
use Tests\Models\User;
use Tests\Models\UserOverride;
use Tests\Models\UserOverrideColumn;
use Tests\Models\UserOverrideColumnConfig;


class LaravelUidTest extends TestCase
{
    /** @test */
    public function can_generate_uid()
    {
        $uid = Uid::make('prefix', 16);
        $this->assertNotNull($uid);
        $this->assertIsString($uid);
        $this->assertStringContainsString('prefix_', $uid);
    }

    /** @test */
    public function uid_length_changes()
    {
        $uid = Uid::make('prefix', 10);
        $this->assertEquals(10, strlen($uid), 'Error: The length of the uid was not able to be changed.');

        $uid = Uid::make('prefix', 24);
        $this->assertEquals(24, strlen($uid), 'Error: The length of the uid was not able to be changed.');
    }

    /** @test */
    public function uid_can_have_a_prefix()
    {
        $uid = Uid::make('prefixChange', 17);
        $this->assertStringContainsString('prefixChange', $uid, 'Error: The prefix was not able to be changed.');
    }

    /** @test */
    public function uid_does_not_need_a_prefix()
    {
        $uid = Uid::make('', 17);
        $this->assertEquals(17, strlen($uid));
        $this->assertFalse(Str::contains($uid, '_'), 'Error: The prefix is still being added when no prefix is set.');
    }

    /** @test */
    public function can_change_characters_in_config()
    {
        config(['laravel-uid.characters' => '0']);
        $uid = Uid::make('test');

        $this->assertEquals('test_00000000000', $uid, 'Error: The uid is not pulling characters from the config.');
    }

    /** @test */
    public function can_change_prefix_separator_in_config()
    {
        config(['laravel-uid.prefix_separator' => '-']);
        $uid = Uid::make('test');

        $this->assertStringContainsString('-', $uid, 'Error: The uid is not pulling prefix separator from the config.');
    }

    /** @test */
    public function can_change_default_length_in_config()
    {
        config(['laravel-uid.length' => 32]);
        $user = User::create(['name' => 'First Last']);
        $this->assertEquals(32, strlen($user->uid), 'Error: The default length of the uid was not able to be changed from the config.');

        config(['laravel-uid.length' => 42]);
        $user2 = User::create(['name' => 'First Last']);
        $this->assertEquals(42, strlen($user2->uid), 'Error: The default length of the uid was not able to be changed from the config.');

    }

    /** @test */
    public function can_change_uid_column_in_config()
    {
        config(['laravel-uid.uid_column' => 'uidCustomConfig']);
        $user = UserOverrideColumnConfig::create(['name' => 'First Last']);
        $foundUser = UserOverrideColumnConfig::findByUid($user->uidCustomConfig);

        $this->assertTrue($user->is($foundUser), 'Error: The default uid column was not able to be changed from the config or DB does not have right column name.');
    }

    /** @test */
    public function trait_uid_is_created_with_model_name_prefix_by_default()
    {
        $user = User::create(['name' => 'First Last']);
        $this->assertStringContainsString('user_', $user->uid, 'Error: The default prefix is not using the model name.');
    }

    /** @test */
    public function uid_trait_prefix_can_be_changed()
    {
        $user = UserOverride::create(['name' => 'First Last']);
        $this->assertStringContainsString('usr_', $user->uid, 'Error: The prefix was not be able to be changed using the override in the trait.');
    }

    /** @test */
    public function uid_trait_length_can_be_changed()
    {
        $user = UserOverride::create(['name' => 'First Last']);
        $this->assertEquals(10, strlen($user->uid), 'Error: The length was not be able to be changed using the override in the trait.');
    }

    /** @test */
    public function uid_trait_column_can_be_changed()
    {
        $user = UserOverrideColumn::create(['name' => 'First Last']);

        $this->assertEquals(32, strlen($user->uidCustomColumn), 'Error: The uid column was not be able to be changed using the override in the trait.');
    }

    /** @test */
    public function can_find_instance_using_findByUid()
    {
        // Normal Model
        $user = User::create(['name' => 'First Last']);
        User::create(['name' => 'Wrong Person']);
        $foundUser = User::findByUid($user->uid);

        $this->assertTrue($user->is($foundUser));

        // Model with trait override
        $user2 = UserOverrideColumn::create(['name' => 'First Last']);
        UserOverrideColumn::create(['name' => 'Wrong Person']);
        $foundUser2 = UserOverrideColumn::findByUid($user2->uidCustomColumn);

        $this->assertTrue($user2->is($foundUser2));

        // Model with config changed for default
        config(['laravel-uid.uid_column' => 'uidCustomConfig']);
        $user3 = UserOverrideColumnConfig::create(['name' => 'First Last']);
        UserOverrideColumnConfig::create(['name' => 'Wrong Person']);
        $foundUser3 = UserOverrideColumnConfig::findByUid($user3->uidCustomConfig);

        $this->assertTrue($user3->is($foundUser3));
    }
}
