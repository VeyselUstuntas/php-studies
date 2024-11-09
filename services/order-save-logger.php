<?php

#[Attribute]
class OrderSaveLogger{
    public string $message;

    public function __construct()
    {
        $this->message = "Yeni Sipariş Eklendi.";
    }

}