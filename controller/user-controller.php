<?php
include __DIR__ . '/../model/user.php';
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
