<?php namespace Keep\Repositories\Notification;

use Carbon\Carbon;
use Keep\User;
use Keep\Notification;

class DbNotificationRepository implements NotificationRepositoryInterface {

    public function count()
    {
        return Notification::count();
    }

    public function create(array $data)
    {
        return Notification::create([
            'subject'   => $data['subject'],
            'body'      => $data['body'],
            'type'      => $data['type'],
            'is_read'   => false,
            'sent_at'   => Carbon::now()
        ]);
    }

    public function getPaginatedNotifications($limit)
    {
        return Notification::where('sent_from', 'admin')->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function fetchAll($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->notifications()->unread()->orderBy('created_at', 'desc')->paginate(15);
    }

    public function countUserNotifications($user)
    {
        return $user->notifications()->unread()->count();
    }

}