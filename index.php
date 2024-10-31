<?php

require 'router.php';
require 'route.php';
require 'controller/fibonacci-number-controller.php';
require 'controller/prime-number-controller.php';
require 'controller/home-controller.php';
require_once 'fibonacci-number.php';
require_once 'prime-number.php';

$router = new Router();

$fibonacciControllerObj = new FibonacciNumberController(new FibonacciNumber());
Router::get("fibonacci", [$fibonacciControllerObj, 'getFibonacciNumbers']);

$primeControllerObj = new PrimeNumberController(new PrimeNumber());
Router::get("prime-number", [$primeControllerObj, 'getPrimeNumbers']);

$home = new HomeController();
Router::get("home", [$home, 'getHomePage']); 

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
