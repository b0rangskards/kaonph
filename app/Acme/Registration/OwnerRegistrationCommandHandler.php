<?php  namespace Acme\Registration; 

use Acme\Users\UserRepository;
use Auth;
use Laracasts\Commander\CommandHandler;
use User;

class OwnerRegistrationCommandHandler implements CommandHandler {

    private $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::registerOwner(
            $command->email,
            $command->password
        );

        $this->repository->save($user);

        Auth::loginUsingId($user->id);

        return $user;
    }
}