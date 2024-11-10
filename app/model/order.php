<?php
namespace Model;


class Order{
    public int $id;
    public int $userId;
    /**
     * @var OrderItem[]
     */
    public array $items;

    public function __construct()
    {

    }

    function addItem(OrderItem $item){
        $this->items[] = $item;
    }
}