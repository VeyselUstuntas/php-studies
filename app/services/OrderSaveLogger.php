<?php
namespace App\Services;
use Attribute;

#[Attribute]
class OrderSaveLogger{
    public string $message;

    public function __construct()
    {
        $this->message = "Yeni Sipariş Eklendi.";
    }

}