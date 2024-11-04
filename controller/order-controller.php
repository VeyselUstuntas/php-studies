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
        echo "<pre>". $this->orderService->getAllOrdersPresentation(). "</pre>";
        // $this->orderService->getAllOrdersDetails();

    }

    public function saveOrder()
    {
        $product_id = $_POST["product_id"] ?? null;
        $quantity = $_POST["quantity"] ?? null;
        if ($product_id != null && $quantity != null) {
            $this->orderService->saveOrder($product_id, $quantity);
            require __DIR__ . "/../view/success.php";
            $this->showOrderForm();
        }
        else{
            require __DIR__ . "/../view/error.php";
            $this->showOrderForm();
        }
    }

    public function showOrderForm()
    {
        $this->orderService->showOrderForm();
    }
}
