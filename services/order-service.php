<?php
include __DIR__ .  '/../services/user-service.php';
include __DIR__ .  '/../services/product-service.php';
include __DIR__ .  '/../model/order.php';
include __DIR__ .  '/../model/order-details.php';
include __DIR__ . '/../model/order-item.php';
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

    private Database $database;

    public function __construct()
    {
        $this->orderList = [];
        $this->database = new Database();
    }

    /**
     * @return Order[] $getAllgetAllOrdersDetails
     */
    public function getAllOrdersDetails(): array
    {
        try {
            $connection = $this->database->connection;
            $stmt = $connection->prepare("SELECT CONCAT(u.name,' ',UPPER(u.surname)) as 'customer_info',o.id as 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi LEFT OUTER JOIN orders as o on o.id = oi.order_id LEFT OUTER JOIN user as u on u.id = o.user_id LEFT OUTER JOIN product as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;");

            $stmt->execute();
            $this->orderList = [];

            while ($row = $stmt->fetch()) {
                $this->orderList[] = new OrderDetails($row);
            }

            return $this->orderList;
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

    /**
     * @param OrderSaveModel $orderSaveModel
     */
    public function saveOrder(OrderSaveModel $orderSaveModel): Order
    {
        $items = $orderSaveModel->items;
        $userId = $orderSaveModel->userId;

        try {
            $connection = $this->database->connection;

            $stmt = $connection->prepare("INSERT INTO orders(user_id) VALUES(:userId)");
            $stmt->execute(['userId' => $userId]);

            $orderId = $connection->lastInsertId("orderId");

            $order = new Order([
                'id' => $orderId,
                'userId' => $userId
            ]);

            foreach ($items as $item) {
                $orderItemSaveModel = new OrderItemSaveModel(['orderId' => $orderId, 'productId' => $item->productId, 'qty' => $item->qty]);
                $orderItem = $this->saveOrderItem($orderItemSaveModel);
                $order->addItem($orderItem);
            }
            return $order;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function saveOrderItem(OrderItemSaveModel $model): OrderItem
    {
        try {
            $connection = $this->database->connection;

            $stmt = $connection->prepare("INSERT INTO order_items(order_id,product_id, quantity) VALUES(:order_id, :product_id,:quantity)");

            $stmt->execute(['order_id' => $model->orderId, 'product_id' => $model->productId, 'quantity' => $model->qty]);

            $orderItemResult = $connection->prepare("SELECT * from order_items where order_id = :last_order_id");
            $orderItemResult->execute(['last_order_id' => $model->orderId]);

            while ($row = $orderItemResult->fetch()) {
                $orderItem = new OrderItem([
                    'id' => $row['id'],
                    'order_id' => $row['order_id'],
                    'product_id' => $row['product_id'],
                    'quantity' => $row['quantity']
                ]);
                return $orderItem;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function sqlInjectionTest(int $user_id)
    {
        $connection = $this->database->connection;
    
        try {
            //prepared Statment
            $stmt = $connection->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam('id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            //unPrepared Statment
            $sql = "SELECT * FROM user WHERE id = $user_id";
            $result = $connection->query($sql);
    
            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
    
            return $users; 
        } catch (Exception $e) {
            echo $e->getMessage(); 
        }
    }
    
}
