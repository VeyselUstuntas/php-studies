<?php
namespace Config;
use PDO;

class Database
{
    private string $hostname = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "storedb";
    public PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database",$this->username,$this->password);
    }


}
