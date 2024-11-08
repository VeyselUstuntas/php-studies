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

require 'middleware/first-middleware.php';
require 'middleware/second-middleware.php';
require 'middleware/third-middleware.php';
require 'middleware/core/middleware-stack.php';
require 'app.php';

$diManager = new DIManager();
$router = new Router($diManager);
$request = RequestParser::parse();

$app = new App(new MiddlewareStack($request));
$app->add(new FirstMiddleware());
$app->add(new SecondMiddleware($diManager->resolve(OrderController::class)));
$app->add(new ThirdMiddleware());

$app->run();

Router::get("fibonacci", [FibonacciNumberController::class, 'getFibonacciNumbers']);

Router::get("prime-number", [PrimeNumberController::class, 'getPrimeNumbers']);

Router::get("orders", [OrderController::class, 'getOrdersInfo']);

Router::post("orders", [OrderController::class, 'saveOrder']);

Router::post("injection", [OrderController::class, 'testSqlInjection']);

Router::get("users", [UserController::class, 'getAllUser']);

Router::get("user", [UserController::class, 'getUser']);

Router::get("products", [ProductController::class, 'getAllProducts']);

$router->route($request);
