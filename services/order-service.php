<?php
include __DIR__ .  '/../services/user-service.php';
include __DIR__ .  '/../services/product-service.php';
include __DIR__ .  '/../model/order.php';
include __DIR__ .  '/../model/order-item.php';
include __DIR__ .  '/../utilities/json-utility.php';

class OrderService
{
    /**
     * @var Order[] $orderList
     */
    private array $orderItemList;

    /**
     * @var OrderItem[] $orderList
     */
    private array $orderList;

    private Database $database;

    public function __construct()
    {
        $this->orderItemList = [];
        $this->database = new Database();
    }

    /**
     * @return Order[] $getAllgetAllOrdersDetails
     */
    public function getAllOrdersDetails(): array
    {
        try {
            $connection = $this->database->connection;
            $query = "SELECT CONCAT(u.name,' ',UPPER(u.surname)) 'costumer_info',o.id 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi LEFT OUTER JOIN orders as o on o.id = oi.order_id LEFT OUTER JOIN user as u on u.id = o.user_id LEFT OUTER JOIN product as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;";
            $orders = mysqli_query($connection, $query);

            if ($orders->num_rows > 0) {
                while ($row = $orders->fetch_assoc()) {
                    $this->orderItemList[] = new Order($row["costumer_info"], $row["order_id"], $row["product_name"], $row["product_price"], $row["piece"], $row["total_cost"]);
                }
            }

            mysqli_close($connection);
            // return include __DIR__ . "/../view/order-list.php";
            return $this->orderItemList;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllOrdersPresentation(): string|false
    {
        $orderObjectList = $this->getAllOrdersDetails();
        $orderJsonEncodeList = JsonUtility::encode($orderObjectList);
        return $orderJsonEncodeList;
    }

    public function saveOrder(int $order_id,int $product_id, int $quantity)
    {
        try {
            $connection = $this->database->connection;

            $query = "INSERT INTO order_items(order_id,product_id, quantity) VALUES(?,?,?)";

            $stmt = mysqli_prepare($connection, $query);

            $order_id = $order_id;
            $product_id = $product_id;
            $quantity = $quantity;
            mysqli_stmt_bind_param($stmt, "iii", $order_id, $product_id, $quantity);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
            mysqli_close($connection);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getOrderList(): array
    {
        try {
            $connection = $this->database->connection;
            $query = "SELECT * FROM orders";
            $products = mysqli_query($connection, $query);
            if ($products->num_rows > 0) {
                while ($row = $products->fetch_assoc()) {

                    $this->orderList[] = new OrderItem($row["id"], $row["user_id"]);
                }
                mysqli_close($connection);
                return $this->orderList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function showOrderForm()
    {
        $productService = new ProductService();
        /**
         * @var Product[] $products
         * 
         */
        $products = $productService->getProductList();
        /**
         * @var OrderItem[] $orders
        */
        $orders = $this->getOrderList();
        return include __DIR__ . "/../view/save-order.php";
    }
}
