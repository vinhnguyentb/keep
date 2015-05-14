<?php namespace Keep\Mailers;

use Keep\Task;
use Keep\User;
use Carbon\Carbon;

class UserMailer extends Mailer {

    /**
     * Send account activation link.
     *
     * @param User $user
     * @param      $activationCode
     */
    public function sendAccountActivationLink(User $user, $activationCode)
    {
        $subject = 'Account Activation';
        $view = 'emails.auth.account_activation';
        $data = ['activationLink' => route('account.activation', $activationCode)];

        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send activated account confirmation.
     *
     * @param User $user
     */
    public function sendAccountActivatedConfirmation(User $user)
    {
        $subject = 'Activated Account Confirmation';
        $view = 'emails.auth.account_activated';

        $this->sendTo($user, $subject, $view);
    }

    /**
     * Send notification about newly created task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutNewTask(User $user, Task $task)
    {
        $subject = 'Keep - New task notification';
        $view = 'emails.task.new_task';
        $data = [
            'username'       => $user->name,
            'task_title'     => $task->title,
            'task_content'   => $task->content,
            'starting_date'  => Carbon::parse($task->starting_date)->format('Y-m-d'),
            'finishing_date' => Carbon::parse($task->finishing_date)->format('Y-m-d'),
        ];

        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send notification to users about their upcoming task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutUpcomingTask(User $user, Task $task)
    {
        $subject = 'Keep - Upcoming task notification';
        $view = 'emails.task.upcoming_task';
        $data = [
            'username'       => $user->name,
            'task_title'     => $task->title,
            'task_content'   => $task->content,
            'starting_date'  => Carbon::parse($task->starting_date)->format('Y-m-d'),
            'finishing_date' => Carbon::parse($task->finishing_date)->format('Y-m-d'),
            'remaining_days' => $task->present()->getRemainingDays($task->finishing_date)
        ];

        $this->sendTo($user, $subject, $view, $data);
    }

}