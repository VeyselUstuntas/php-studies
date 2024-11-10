<?php
namespace Controller;

use Services\ProductService;
use Utilities\JsonUtility;

class ProductController
{
    public function __construct(protected ProductService $productService) {}

    public function getAllProducts()
    {
        $productList = $this->productService->getAllProducts();
        die(JsonUtility::encode($productList));
    }
}
