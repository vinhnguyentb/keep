<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertBelongsToMany('users', 'Keep\Entities\Group');
    }

    /** @test */
    public function it_belongs_to_many_assignments()
    {
        $this->assertMorphToMany('assignments', 'Keep\Entities\Group');
    }

    /** @test */
    public function it_belongs_to_many_notifications()
    {
        $this->assertMorphToMany('notifications', 'Keep\Entities\Group');
    }

    /** @test */
    public function it_can_be_notified()
    {
        $group = factory('Keep\Entities\Group')->create();
        $notification = factory('Keep\Entities\Notification')->create();
        $group->notify($notification);
        $this->assertTrue($group->notifications->contains($notification));
    }
}
