<?php

class NotificationTest extends UnitTestCase
{
    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertMorphedByMany('users', Keep\Entities\Notification::class);
    }

    /** @test */
    public function it_belongs_to_many_groups()
    {
        $this->assertMorphedByMany('groups', Keep\Entities\Notification::class);
    }
}
