<?php
include __DIR__ . '/../model/product.php';
class ProductController
{
    private ProductService $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
}
