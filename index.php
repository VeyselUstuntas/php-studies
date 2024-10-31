<?php
require 'router.php';
require 'route.php';
require 'controller/fibonacci-controller.php';
require 'controller/prime-controller.php';
require 'controller/home-controller.php';
require_once 'fibonacci.php';
require_once 'prime-number.php';

$router = new Router();

$fibonacci = new FibonacciController(new Fibonacci());
Router::get("fibonacci", $fibonacci->fibonacci());

$prime = new PrimeController(new PrimeNumber());
Router::get("prime-number", $prime->prime());

$home = new HomeController();
Router::get("home", $home->home());

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
