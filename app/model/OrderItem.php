<?php
namespace App\Model;

class OrderItem
{
    public int $id;
    public int $orderId;
    public int $productId;
    public int $quantity;

    public function __construct()
    {

    }
}
