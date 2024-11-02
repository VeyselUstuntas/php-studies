<?php
include __DIR__ . '/../model/product.php';
class ProductController
{
    /**
     * @var Product[] $productList
     */
    private $productList = [];
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
        // $this->getAllProduct();
    }

    public function getAllProduct()
    {
        $connection = $this->database->connection;
        $query = "SELECT * FROM product";
        $products = mysqli_query($connection, $query);
        if ($products->num_rows > 0) {
            while ($row = $products->fetch_assoc()) {

                $this->productList[] = new Product($row["id"], $row["name"], $row["price"]);
            }
            mysqli_close($connection);
            return $this->productList;
        } else {
            mysqli_close($connection);
            echo "Ürün Bilgileri Getirilemedi.";
            exit;
        }
    }
}
