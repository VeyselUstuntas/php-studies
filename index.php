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
require 'config/query-builder.php';
require 'events/event.php';
require 'services/order-save-logger.php';

$diManager = new DIManager();

$router = new Router($diManager);
$request = RequestParser::parse();

Router::get("fibonacci",[FibonacciNumberController::class, 'getFibonacciNumbers']);

Router::get("prime-number", [PrimeNumberController::class, 'getPrimeNumbers']);

Router::get("order-presentation", [OrderController::class, 'getOrdersPresentation']);

Router::get("orders", [OrderController::class, 'getOrdersInfo'], [
    "before" => [FirstMiddleware::class],
    "after" => [SecondMiddleware::class]
]);

Router::post("orders", [OrderController::class, 'saveOrder']);

Router::post("injection", [OrderController::class, 'testSqlInjection']);

Router::get("users", [UserController::class, 'getAllUser']);

Router::get("user", [UserController::class, 'getUser']);

Router::get("products", [ProductController::class, 'getAllProducts']);

$controller = $diManager->resolve(OrderController::class);
$reflection = new ReflectionClass($controller);
$method = $reflection->getMethod("saveOrder");
$attributes = $method->getAttributes(OrderSaveLogger::class); // ReflectionAttribute saveOrder'a verilen attribute'un meta bilgilerini tutar.
foreach ($attributes as $attr) {
    var_dump($attr);
    Event::eventListen("orderSaved",function() use($attr){
        $logger = $attr->newInstance();
        var_dump($logger->message);
    });
}

$router->route($request);