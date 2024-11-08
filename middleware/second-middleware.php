<?php
class SecondMiddleware implements IMiddleware
{
    public function __construct(protected OrderController $orderController) {}
    public function __invoke(callable $next)
    {
        var_dump("second middleware");
        
        $orderList = $this->orderController->getOrdersInfo();
        $jsonResult = JsonUtility::encode($orderList);
        
        return $next($jsonResult);
    }
}
