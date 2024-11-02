<?php
class ProductService
{
    /**
     * @var Product[] $productObject
     * 
     */

    private array $productObject;

    public function __construct()
    {
        $productController = new ProductController();
        $this->productObject = $productController->getAllProduct();
    }

    public function getProductList(): array
    {
        return $this->productObject;
    }
}
