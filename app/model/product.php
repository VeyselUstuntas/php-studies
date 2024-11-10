<?php
namespace App\Model;

class Product{
    public int $id;
    public string $name;
    public float $price;

    public function __construct(int $id,string $name,float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

}