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
        die($this->orderService->getAllOrdersPresentation());
    }

    public function saveOrder()
    {
        $data =  json_decode(file_get_contents('php://input'), true);
        $user_id = $data[0]["user_id"] ?? null;
        $orderItemList = [];

        foreach ($data as $item) {
            $product_id = $item["product_id"] ?? null;
            $quantity = $item["quantity"] ?? null;


            if (!is_int($product_id) || !is_int($quantity)) {
                die(json_encode(['error' => 'Invalid product_id or quantity.']));
            }

            $orderItemList[] = new OrderItemSaveModel((int)$product_id, (int)$quantity);
        }

        $orderSaveModel = new OrderSaveModel(['userId' => $user_id, 'items' => $orderItemList]);

        $orderJson = JsonUtility::encode($this->orderService->saveOrder($orderSaveModel));
        die($orderJson);
    }
}
