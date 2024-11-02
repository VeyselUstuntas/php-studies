<?php
class UserController
{

    private Database $database;
    public array $userList = [];

    public function __construct()
    {
        $this->database = new Database();
        $this->getAllUser();
    }

    public function getAllUser()
    {
        $connection = $this->database->connection;
        $query = "SELECT id, name, surname, email FROM user";
        $users = mysqli_query($connection, $query);
        if ($users->num_rows > 0) {
            while ($row = $users->fetch_assoc()) {
                $this->userList[] = array( 
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "surname" => $row["surname"],
                    "email" => $row["email"]
                );
            }

        } else {
            echo "Kullanıcılar Getirilemedi.";
        }

        mysqli_close($connection);
    }
}
