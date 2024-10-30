<?php
require 'router.php';
require 'route.php';

$router = new Router();

$router->register(
    new Route(
        'fibonacci',
        function ($parameter) {
            require 'fibonacci.php';
            $fibonacci = new Fibonacci();
            $fibonacci->setFibonacciStep($parameter);
            $result = $fibonacci->stringify();
            $title = "Fibonacci Numbers";
            require "show.php";
        }
    )
);

$router->register(
    new Route(
        'prime-number',
        function ($parameter) {
            require 'prime-number.php';
            $primeNumber = new PrimeNumber();
            $primeNumber->setPrimeNumberLimit($parameter);
            $result = $primeNumber->stringify();
            $title = "Prime Numbers";
            require "show.php";
        }
    )
);

$router->register(new Route('home', function () {
    require 'home.php';
}));


$router->route($_SERVER['REQUEST_URI']);
