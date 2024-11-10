<?php
namespace Model;

class OrderSaveModel {
    public int $userId;
    /**
     * @var OrderItemSaveModel[]
     */
    public array $items;

    /**
     * @param OrderItemSaveModel[] $items
    */
    public function __construct(array $data)
    {
        $this->userId = $data['userId'];
        $this->items = $data['items'];
    }
}