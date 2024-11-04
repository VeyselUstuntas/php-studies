<?php
include __DIR__ . "/../view/_layout.php";
$order_id = $this->orderList[0]->order_id;
$colorIndex = 0;
$colorList = array("table-primary", "table-secondary", "table-success", "table-danger", "table-warning", "table-info", "table-light", "table-dark");

echo $jsonEncodeList;
?>
<div class="container mt-2">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Order Id</th>
                <th scope="col">Customer</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Cost</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->orderItemList as $order) :
            ?>
                <?php
                if ($order->order_id != $order_id) {
                    $colorIndex = ($colorIndex + 1) % 8;
                }
                $order_id = $order->order_id;
                ?>
                <tr class="<?php echo $colorList[$colorIndex]; ?>">
                    <td><?php echo htmlspecialchars($order->order_id); ?></td>
                    <td><?php echo htmlspecialchars($order->costumer_info); ?></td>
                    <td><?php echo htmlspecialchars($order->product_name); ?></td>
                    <td><?php echo htmlspecialchars($order->product_price); ?></td>
                    <td><?php echo htmlspecialchars($order->piece); ?></td>
                    <td><?php echo htmlspecialchars($order->total_cost); ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-5">
        <a class="btn btn-warning" href="/../php-calismasi/home/">Home</a>
    </div>
</div>