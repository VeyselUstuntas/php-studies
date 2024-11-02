<?php

require 'core/router.php';
require 'core/model/route.php';
require 'controller/fibonacci-number-controller.php';
require 'controller/prime-number-controller.php';
require 'controller/home-controller.php';
require_once 'fibonacci-number-calculator.php';
require_once 'prime-number-calculator.php';
require 'core/request-parser.php';

$request = RequestParser::parse($_SERVER);

$router = new Router();

Router::get("fibonacci", [new FibonacciNumberController(), 'getFibonacciNumbers']);

Router::get("prime-number", [new PrimeNumberController(), 'getPrimeNumbers']);

$home = new HomeController();
Router::get("home", [$home, 'getHomePage']); 

$router->route($request);