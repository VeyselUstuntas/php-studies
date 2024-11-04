<?php
require "_layout.php";
/**
 * @var Product[] $products
 */
$products;

/**
 * @var OrderItem[] $orders
 */
$orders;
?>

<div class="container mt-2">
    <form method="POST" action="/php-calismasi/orders/">

        <div class="form-group mt-2">
            <label for="product_id">Select Order</label>
            <select class="form-control" id="order_id" name="order_id">
                <option value="">Select a Order</option>
                <?php foreach ($orders as $value): ?>
                    <option value="<?php echo $value->id; ?>">
                        <?php echo $value->id; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="product_id">Select Order</label>
            <select class="form-control" id="product_id" name="product_id">
                <option value="">Select a product</option>
                <?php foreach ($products as $value): ?>
                    <option value="<?php echo $value->id; ?>">
                        <?php echo $value->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-group mt-2">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Product quantity" require>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary my-2">Submit</button>
            <a class="btn btn-success" href="/php-calismasi/home/">Home</a>
        </div>
    </form>
</div>