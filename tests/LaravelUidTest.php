<?php

namespace Tests;

use Tests\TestCase;
use Alecgarcia\LaravelUid\Uid;

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
}
