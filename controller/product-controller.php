<?php
include __DIR__ . '/../model/product.php';
class ProductController
{
    public function __construct(protected ProductService $productService) {}

    public function getAllProducts()
    {
        $productList = $this->productService->getAllProducts();
        die(JsonUtility::encode($productList));
    }
}
