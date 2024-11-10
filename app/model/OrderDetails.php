<?php
namespace App\Model;

class OrderDetails
{
    public string $customerInfo;
    public int $orderId;
    public string $productName;
    public float $productPrice;
    public int $piece;
    public float $totalCost;

    public function __construct($data)
    {
        $this->customerInfo = $data['customer_info'] ?? null;
        $this->orderId = $data['order_id'] ?? null;
        $this->productName = $data['product_name'] ?? null;
        $this->productPrice = $data['product_price'] ?? null;
        $this->piece = $data['piece'] ?? null;
        $this->totalCost = $data['total_cost'] ?? null;
    }
}
