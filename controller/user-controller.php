<?php
include __DIR__ . '/../model/user.php';
class UserController
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getUser(int $userId)
    {
        $user = $this->userService->getUser($userId);
        die(JsonUtility::encode([$user]));
    }

    public function getAllUser() {
        $userList = $this->userService->getAllUser();
        die(JsonUtility::encode($userList));
    }
}
