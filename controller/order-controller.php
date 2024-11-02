<?php
class OrderController
{
    private Database $database;
    public array $orderList = []; 
    public array $userList = [];
    public array $productList = [];

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getOrdersInfo()
    {
        $userController= new UserController();
        $this->userList = $userController->userList;

        $productController = new ProductController();
        $this->productList = $productController->productList;

        $this->getAllOrdersDetails();
        require 'view/order-list.php'; 
    }

    public function getAllOrdersDetails()
    {
        $connection = $this->database->connection;
        $query = "SELECT o.id 'order_id', CONCAT(u.name, ' ', u.surname) as 'name_surname', p.name as 'product', p.price 'price' FROM orders as o JOIN user as u on o.user_id=u.id JOIN product as p on o.product_id=p.id;";
        $orders = mysqli_query($connection, $query);

        if ($orders->num_rows > 0) {
            while ($row = $orders->fetch_assoc()) {
                $this->orderList[] = array( 
                    "order_id" => $row["order_id"],
                    "name_surname" => $row["name_surname"],
                    "product" => $row["product"],
                    "price" => $row["price"]
                );
            }
        } else {
            echo "Kullanıcılar Getirilemedi.";
        }

        mysqli_close($connection);
    }
}
