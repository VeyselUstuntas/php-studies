<?php

class OrderItemSaveModel {
    public int $productId;
    public int $qty;

    public function __construct(array $data)
    {
        $this->productId = $data['productId'];
        $this->qty = $data['qty'];
    }
}