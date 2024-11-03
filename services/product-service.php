<?php
class ProductService
{
    /**
     * @var Product[] $productList
     * 
     */

    private array $productList;
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->productList = [];
    }

    public function getProductList(): array
    {
        try {
            $connection = $this->database->connection;
            $query = "SELECT * FROM product";
            $products = mysqli_query($connection, $query);
            if ($products->num_rows > 0) {
                while ($row = $products->fetch_assoc()) {

                    $this->productList[] = new Product($row["id"], $row["name"], $row["price"]);
                }
                mysqli_close($connection);
                return $this->productList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
