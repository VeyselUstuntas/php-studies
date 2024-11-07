<?php
require 'core/router.php';
require 'core/model/route.php';
require 'controller/fibonacci-number-controller.php';
require 'controller/prime-number-controller.php';
require 'controller/home-controller.php';
require 'services/fibonacci-number-calculator.php';
require 'services/prime-number-calculator.php';
require 'core/request-parser.php';
require 'config/database.php';
require 'controller/user-controller.php';
require 'controller/product-controller.php';
require 'controller/order-controller.php';
require 'core/di-manager.php';

$diManager = new DIManager();

$router = new Router($diManager);

Router::get("fibonacci", [FibonacciNumberController::class, 'getFibonacciNumbers']);

Router::get("prime-number", [PrimeNumberController::class, 'getPrimeNumbers']);

Router::get("orders", [OrderController::class, 'getOrdersInfo']);

Router::post("orders", [OrderController::class, 'saveOrder']);

Router::post("injection", [OrderController::class, 'testSqlInjection']);

Router::get("users", [UserController::class, 'getAllUser']);

Router::get("user", [UserController::class, 'getUser']);

Router::get("products", [ProductController::class, 'getAllProducts']);

$request = RequestParser::parse();
$router->route($request);

