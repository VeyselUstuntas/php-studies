<?php

class OrderSaveModel {
    public int $user_id;
    /**
     * @var OrderItemSaveModel[]
     */
    public array $items;

    /**
     * @param OrderItemSaveModel[] $items
    */
    public function __construct(int $user_id, array $items)
    {
        $this->user_id = $user_id;
        $this->items = $items;
    }
}