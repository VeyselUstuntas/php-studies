<?php
include __DIR__ . '/../model/user.php';
class UserController
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }
}
