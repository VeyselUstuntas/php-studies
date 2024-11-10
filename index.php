<?php

use App\Controller\FibonacciNumberController;
use App\Controller\OrderController;
use App\Controller\PrimeNumberController;
use App\Controller\ProductController;
use App\Controller\UserController;
use App\Core\DIManager;
use App\Core\RequestParser;
use App\Core\Router;
use App\Events\Event;
use App\Middleware\FirstMiddleware;
use App\Middleware\SecondMiddleware;
use App\Services\OrderSaveLogger;

require_once __DIR__ . '/vendor/autoload.php';
$diManager = new DIManager();

$router = new Router($diManager);
$request = RequestParser::parse();

Router::get("fibonacci", [FibonacciNumberController::class, 'getFibonacciNumbers']);

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
    Event::eventListen("orderSaved", function () use ($attr) {
        $logger = $attr->newInstance();
        var_dump($logger->message);
    });
}

$router->route($request);
