<?php
namespace Controller;

use Services\UserService;
use Utilities\JsonUtility;

class UserController
{
    public function __construct(protected UserService $userService) {}

    public function getUser(int $userId)
    {
        $user = $this->userService->getUser($userId);
        die(JsonUtility::encode([$user]));
    }

    public function getAllUser()
    {
        $userList = $this->userService->getAllUser();
        die(JsonUtility::encode($userList));
    }
}
