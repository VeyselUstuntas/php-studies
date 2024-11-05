<?php

class OrderItemSaveModel {
    public ?int $orderId;
    public int $productId;
    public int $qty;

    public function __construct(array $data)
    {
        $this->orderId = $data['orderId'] ?? null;
        $this->productId = $data['productId'];
        $this->qty = $data['qty'];
    }
}