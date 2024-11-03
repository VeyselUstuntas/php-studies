<?php

include __DIR__ .  '/../services/order-service.php';
class OrderController
{
    private OrderService $orderService;
    public function __construct()
    {
        $this->orderService = new OrderService();
    }


    public function getOrdersInfo()
    {
        echo $this->orderService->getAllOrdersPresentation();
    }
}
