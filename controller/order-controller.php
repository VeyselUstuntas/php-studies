<?php

include __DIR__ .  '/../services/order-service.php';
include __DIR__ .  '/../model/order-item-save.php';
include __DIR__ .  '/../model/order-save.php';

class OrderController
{
    private OrderService $orderService;
    private $requestData;
    public function __construct(BaseRequest $request)
    {
        $this->orderService = new OrderService();
        $this->requestData = $request->data;
    }


    public function getOrdersInfo()
    {
        die($this->orderService->getAllOrdersPresentation());
    }

    public function saveOrder()
    {
        $user_id = $this->requestData[0]["user_id"] ?? null;
        $orderItemList = [];

        foreach ($this->requestData as $item) {
            $productId = $item["product_id"];
            $qty = $item["quantity"];

            $orderItemSaveModel = new OrderItemSaveModel(['productId' => $productId, 'qty' => $qty]);
            $orderItemList[] = $orderItemSaveModel;
        }

        $orderSaveModel = new OrderSaveModel(['userId' => $user_id, 'items' => $orderItemList]);

        $orderJson = JsonUtility::encode([$this->orderService->saveOrder($orderSaveModel)]);
        die($orderJson);
    }

    public function testSqlInjection()
    {
        $user_id = $this->requestData[0]["user_id"] ?? null;

        $sqlInjectionTest = JsonUtility::encode($this->orderService->sqlInjectionTest((int)$user_id));
        die($sqlInjectionTest);
    }
}
