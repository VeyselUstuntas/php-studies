<?php
namespace App\Middleware;

use App\Utilities\JsonUtility;

class SecondMiddleware
{
    public function __invoke(array $orderList)
    {
        var_dump("second middleware");
        $orderList = $orderList;
        $jsonResult = JsonUtility::encode($orderList);
        var_dump($jsonResult);
    }
}
