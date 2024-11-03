<?php
include __DIR__ . "/../view/_layout.php";
$order_id = $this->orderList[0]->order_id;
$colorIndex = 0;
$colorList = array("table-primary", "table-secondary", "table-success", "table-danger", "table-warning", "table-info", "table-light", "table-dark");
?>
<div class="container mt-2">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order-details">
                    Order Details
                </button>
            </h2>
            <div id="order-details" class="accordion-collapse collapse show">
                <div class="accordion-body">
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
                            <?php foreach ($this->orderList as $order) :
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
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-details">
                    User Details
                </button>
            </h2>
            <div id="user-details" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->userList as $user) :
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user->id); ?></td>
                                    <td><?php echo htmlspecialchars($user->name); ?></td>
                                    <td><?php echo htmlspecialchars($user->surname); ?></td>
                                    <td><?php echo htmlspecialchars($user->email); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product-details">
                    Product Details
                </button>
            </h2>
            <div id="product-details" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->productList as $product) :
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product->id); ?></td>
                                    <td><?php echo htmlspecialchars($product->name); ?></td>
                                    <td><?php echo htmlspecialchars($product->price); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a class="btn btn-warning" href="/../php-calismasi/home/">Home</a>
    </div>
</div>