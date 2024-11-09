<?php

include __DIR__ .  '/../services/order-service.php';
include __DIR__ .  '/../model/order-item-save.php';
include __DIR__ .  '/../model/order-save.php';

class OrderController
{
    public function __construct(protected OrderService $orderService) {}


    public function getOrdersInfo():array
    {
        return $this->orderService->getAllOrdersDetails();
    }

    public function getOrdersPresentation()
    {
        die($this->orderService->getAllOrdersPresentation());
    }

    #[OrderSaveLogger]
    public function saveOrder()
    {
        $baseRequest = RequestParser::parse();

        $user_id = $baseRequest->data[0]["user_id"] ?? null;
        $orderItemList = [];

        foreach ($baseRequest->data as $item) {
            $productId = $item["product_id"];
            $qty = $item["quantity"];

            $orderItemSaveModel = new OrderItemSaveModel(['productId' => $productId, 'qty' => $qty]);
            $orderItemList[] = $orderItemSaveModel;
        }

        $orderSaveModel = new OrderSaveModel(['userId' => $user_id, 'items' => $orderItemList]);
        Event::eventEmitter("orderSaved");
        $orderJson = JsonUtility::encode([$this->orderService->saveOrder($orderSaveModel)]);
        die($orderJson);
    }

    public function testSqlInjection()
    {
        $request = RequestParser::parse();
        $user_id = $request->data[0]["user_id"] ?? null;

        $sqlInjectionTest = JsonUtility::encode($this->orderService->sqlInjectionTest($user_id));
        die($sqlInjectionTest);
    }
}
