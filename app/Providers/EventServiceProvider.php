<?php
namespace Keep\Providers;

use DB;
use Auth;
use Keep\Entities\User;
use Keep\Entities\Task;
use Keep\Entities\Profile;
use Keep\Entities\Assignment;
use Keep\Entities\Notification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Keep\Events\UserHasRegistered::class => [
            \Keep\Listeners\EmailAccountActivationLink::class,
        ],
        \Keep\Events\TaskHasPublished::class    => [
            \Keep\Listeners\EmailNewlyCreatedTask::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        User::created(function ($user) {
            $user->profile()->save(new Profile());
        });

        Task::deleting(function ($task) {
            $task->destroyer_id = Auth::user()->id;
            $task->save();
        });

        Task::restoring(function ($task) {
            $task->destroyer_id = 0;
            $task->save();
        });

        Assignment::deleting(function ($assignment) {
            $assignment->task()->update(['destroyer_id' => Auth::user()->id]);
            $assignment->task()->delete();
        });

        Notification::deleting(function ($notification) {
            DB::table('notifiables')->where('notification_id', $notification->id)->delete();
        });
    }
}
