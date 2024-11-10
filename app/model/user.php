<?php
namespace Model;

class User
{
    public int $id;
    public string $name;
    public string $surname;
    public string $email;
    public string $password;

    public function __construct(int $id, string $name, string $surname, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }
}
