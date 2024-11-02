<?php
include __DIR__ . '/../model/user.php';
class UserController
{
    /**
     * @var User[] $userList
     */
    private array $userList = [];
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
        // $this->getAllUser();
    }

    public function getAllUser()
    {
        $connection = $this->database->connection;
        $query = "SELECT id, name, surname, email, password FROM user";
        $users = mysqli_query($connection, $query);
        if ($users->num_rows > 0) {
            while ($row = $users->fetch_assoc()) {

                $this->userList[] = new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"]);
            }
            mysqli_close($connection);
            return $this->userList;
        } else {
            mysqli_close($connection);
            echo "Kullanıcılar Getirilimedi";
            exit;
        }
    }
}
