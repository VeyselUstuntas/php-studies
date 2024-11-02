<?php
class ProductController{
    public $productList = [];
    private Database $database;
    public function __construct()
    {
        $this->database = new Database();
        $this->getAllProduct();
    }

    public function getAllProduct(){
        $connection = $this->database->connection;
        $query = "SELECT * FROM product";
        $products = mysqli_query($connection,$query);
        if($products->num_rows > 0){
            while ($row = $products->fetch_assoc()) {
                $this->productList[] = array( 
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "price" => $row["price"],
                );
            }
        }
        else{
            echo "Ürün Bilgileri Getirilemedi.";
        }
        mysqli_close($connection);
    }
}