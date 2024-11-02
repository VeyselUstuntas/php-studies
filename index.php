<?php

require 'core/router.php';
require 'core/model/route.php';
require 'controller/fibonacci-number-controller.php';
require 'controller/prime-number-controller.php';
require 'controller/home-controller.php';
require 'model/fibonacci-number-calculator.php';
require 'model/prime-number-calculator.php';
require 'core/request-parser.php';
require 'config/database.php';
require 'controller/user-controller.php';
require 'controller/product-controller.php';
require 'controller/order-controller.php';

$request = RequestParser::parse($_SERVER);

$router = new Router();

Router::get("fibonacci", [new FibonacciNumberController(), 'getFibonacciNumbers']);

Router::get("prime-number", [new PrimeNumberController(), 'getPrimeNumbers']);

Router::get("orders",[new OrderController(), 'getOrdersInfo']);

Router::get("home", [new HomeController(), 'getHomePage']); 

$router->route($request);