<?php
namespace Keep\Handlers\Commands;

use App;
use Keep\Events\UserWasRegisteredEvent;
use Keep\Commands\RegisterAccountCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class RegisterAccountCommandHandler
{
    /**
     * Handle the command.
     *
     * @param  RegisterAccountCommand $command
     *
     * @return bool
     */
    public function handle(RegisterAccountCommand $command)
    {
        return $this->register($command);
    }

    /**
     * Register new account.
     *
     * @param RegisterAccountCommand $command
     *
     * @return bool
     */
    private function register(RegisterAccountCommand $command)
    {
        $users = App::make(UserRepositoryInterface::class);
        $user = $users->create($this->getRequestData($command));
        if ( ! $user) {
            return false;
        }
        event(new UserWasRegisteredEvent($user));

        return true;
    }

    /**
     * Get request data.
     *
     * @param RegisterAccountCommand $command
     *
     * @return array
     */
    private function getRequestData(RegisterAccountCommand $command)
    {
        return [
            'name'     => $command->name,
            'email'    => $command->email,
            'password' => $command->password
        ];
    }
}
