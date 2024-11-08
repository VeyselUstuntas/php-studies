<?php
class UserService
{
    private Database $database;

    public function __construct(protected QueryBuilder $chaninedQueries)
    {
        $this->database = new Database();
    }

    public function getUser(int $userId): ?User
    {
        try {
            $connection = $this->database->connection;

            $query = $this->chaninedQueries->select()->columns(["*"])->tableName("user")->where(["id"])->getQuery();
            var_dump($query);

            $stmt = $connection->prepare($query);
            // $stmt = $connection->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
            $stmt->execute();

            /**
             * @var User|null $user
             */
            $user = null;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row['id'], $row['name'],$row['surname'],$row['email'],$row['password']);
            }
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllUser(): array
    {
        /**
         * @var User[] $userList
         * 
         */
        $userList = [];
        try {
            $connection = $this->database->connection;
            $query = $this->chaninedQueries->select()->columns(["*"])->tableName("user")->getQuery();
            var_dump($query);

            // $stmt = $connection->prepare("SELECT id, name, surname, email, password FROM user");
            $stmt = $connection->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userList[] = new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"]);
            }
            return $userList;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
