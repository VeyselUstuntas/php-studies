<?php
include __DIR__ . '/../model/product.php';
class ProductController
{
    private ProductService $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function getAllProducts(){
        $productList = $this->productService->getAllProducts();
        die(JsonUtility::encode($productList));
    }
}
