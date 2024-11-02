<?php
class Order{
    public string $costumer_info;
    public int $order_id;
    public string $product_name;
    public float $product_price;
    public int $piece;
    public float $total_cost;

    public function __construct(string  $costumer_info, int $order_id, string $product_name, float $product_price, int $piece, float $total_cost)
    {
        $this->costumer_info = $costumer_info;
        $this->order_id = $order_id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->piece = $piece;
        $this->total_cost = $total_cost;
    }
}