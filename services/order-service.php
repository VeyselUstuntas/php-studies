<?php
include __DIR__ .  '/../services/user-service.php';
include __DIR__ .  '/../services/product-service.php';
include __DIR__ .  '/../model/order.php';
include __DIR__ .  '/../utilities/json-utility.php';

class OrderService
{
    /**
     * @var Order[] $orderList
     */
    private array $orderList;
    /**
     * @var User[] $userList
     */
    private array $userList;
    /**
     *  @var Product[] $productList
     */
    private array $productList;

    private Database $database;

    public function __construct()
    {
        $this->orderList = [];
        $this->productList = [];
        $this->userList = [];
        $this->database = new Database();
    }

    /**
     * @return Order[] $getAllgetAllOrdersDetails
    */
    public function getAllOrdersDetails():array
    {
        try {
            $connection = $this->database->connection;
            $query = "SELECT CONCAT(u.name,' ',UPPER(u.surname)) 'costumer_info',o.id 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi LEFT OUTER JOIN orders as o on o.id = oi.order_id LEFT OUTER JOIN user as u on u.id = o.user_id LEFT OUTER JOIN product as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;";
            $orders = mysqli_query($connection, $query);

            if ($orders->num_rows > 0) {
                while ($row = $orders->fetch_assoc()) {
                    $this->orderList[] = new Order($row["costumer_info"], $row["order_id"], $row["product_name"], $row["product_price"], $row["piece"], $row["total_cost"]);
                }
            }

            mysqli_close($connection);
            return $this->orderList;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllOrdersPresentation():string|false{
        $orderObjectList = $this->getAllOrdersDetails();
        $orderJsonEncodeList = JsonUtility::orderJsonEncodeList($orderObjectList,JSON_PRETTY_PRINT);
        return $orderJsonEncodeList;
    }
}
