<?php

namespace Keep\Core\Composers;

use Illuminate\Contracts\View\View;
use Keep\Core\Repository\Contracts\UserRepository;
use Keep\Core\Repository\Contracts\GroupRepository;

class NotificationForm
{
    protected $users;
    protected $groups;

    public function __construct(UserRepository $users, GroupRepository $groups)
    {
        $this->users = $users;
        $this->groups = $groups;
    }

    public function compose(View $view)
    {
        $view->with('types', $this->getTypes());
        if (certify_session_key('noti.for', 'members')) {
            $view->with('users', $this->listUsers());
        } elseif (certify_session_key('noti.for', 'groups')) {
            $view->with('groups', $this->listGroups());
        }
    }

    protected function getTypes()
    {
        return [
            'default' => 'general',
            'info' => 'informative',
            'success' => 'successful',
            'warning' => 'warning',
            'danger' => 'danger',
        ];
    }

    protected function listUsers()
    {
        return $this->users->getAll()->lists('name', 'id');
    }

    protected function listGroups()
    {
        return $this->groups->getAll()->lists('name', 'id');
    }
}
