<?php

class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "storedb";
    public PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database",$this->username,$this->password);
    }


}
