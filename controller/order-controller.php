<?php
include __DIR__ .  '/../services/user-service.php';
include __DIR__ .  '/../services/product-service.php';
include __DIR__ .  '/../model/order.php';

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
        $userService = new UserService();
        $this->userList = $userService->getUserList();

        $productService = new ProductService();
        $this->productList = $productService->getProductList();

        $this->getAllOrdersDetails();
        require 'view/order-list.php'; 
    }

    public function getAllOrdersDetails()
    {
        $connection = $this->database->connection;
        $query = "SELECT CONCAT(u.name,' ',UPPER(u.surname)) 'costumer_info',o.id 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi JOIN orders as o on o.id = oi.order_id JOIN user as u on u.id = o.user_id JOIN product as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;";
        $orders = mysqli_query($connection, $query);

        if ($orders->num_rows > 0) {
            while ($row = $orders->fetch_assoc()) {
                $this->orderList[] = new Order($row["costumer_info"],$row["order_id"],$row["product_name"],$row["product_price"],$row["piece"],$row["total_cost"]);
                
            }
        } else {
            echo "Kullanıcılar Getirilemedi.";
        }

        mysqli_close($connection);
    }
}
