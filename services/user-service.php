<?php
class UserService
{
    /**
     * @var User[] $userObject
     * 
     */
    private array $userObject;

    public function __construct()
    {
        $userController = new UserController();
        $this->userObject = $userController->getAllUser();
    }

    public function getUserList(): array
    {
        return $this->userObject;
    }
}
