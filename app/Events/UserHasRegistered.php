<?php

namespace Keep\Events;

use Keep\Entities\User;
use Illuminate\Queue\SerializesModels;

class UserHasRegistered extends AbstractEvent
{
    use SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
