<?php

class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "storedb";
    public $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
    }

}
