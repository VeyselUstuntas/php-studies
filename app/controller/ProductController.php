<?php
namespace App\Controller;

use App\Services\ProductService;
use App\Utilities\JsonUtility;

class ProductController
{
    public function __construct(protected ProductService $productService) {}

    public function getAllProducts()
    {
        $productList = $this->productService->getAllProducts();
        die(JsonUtility::encode($productList));
    }
}
