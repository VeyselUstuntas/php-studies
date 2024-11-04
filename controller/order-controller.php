<?php

include __DIR__ .  '/../services/order-service.php';
include __DIR__ .  '/../model/order-item-save.php';
include __DIR__ .  '/../model/order-save.php';

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
        $user_id = $_POST["user_id"] ?? null;

        $product_id = $_POST["product_id"] ?? null;
        $quantity = $_POST["quantity"] ?? null;

        $orderItemList = array(new OrderItemSaveModel($product_id,$quantity));

        $orderSaveModel = new OrderSaveModel($user_id,$orderItemList);

        if ($user_id != null && $product_id != null && $quantity != null) {
            $this->orderService->saveOrder($orderSaveModel);
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
