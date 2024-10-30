<?php
require 'Router.php';
$router = new Router();
$router->route($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
</head>

<body>
    <?php if ($_SERVER['REQUEST_URI'] == "/php-calismasi/" || $_SERVER['REQUEST_URI'] == "/php-calismasi/index"): ?>
        <div class="container mt-5">
            <div class="btn-group">
                <a class="btn btn-primary btn-sm" href="/php-calismasi/fibonacci/10">Fibonacci</a>
                <a class="btn btn-outline-primary btn-sm" href="/php-calismasi/prime-number/10">Prime Number</a>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>