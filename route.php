<?php
require 'Fibonacci.php';
require 'PrimeNumber.php';

$type = $_GET['type'] ?? null;
$param = $_GET['param'] ?? 0;

if ($type === 'fibonacci') {
    $fibonacci = new Fibonacci($param);
    $result = $fibonacci->fibonacciNumbers();
    $title = "Fibonacci Numbers";
} elseif ($type === 'prime') {
    $prime = new PrimeNumber($param);
    $result = $prime->primeNumbers();
    $title = "Prime Numbers";
} else {
    die("Invalid type");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <p class="h4"><?php echo $title; ?></p>
        <p>
            <?php
            foreach ($result as $number) {
                echo "$number  ";
            }
            ?>
        </p>
        <a class="btn btn-success" href="index.php">Home</a>
    </div>
</body>
</html>
