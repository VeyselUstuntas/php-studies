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

$fibonacciControllerObj = new FibonacciNumberController(new FibonacciNumberCalculator());
Router::get("fibonacci", [$fibonacciControllerObj, 'getFibonacciNumbers']);

$primeControllerObj = new PrimeNumberController(new PrimeNumberCalculator());
Router::get("prime-number", [$primeControllerObj, 'getPrimeNumbers']);

$home = new HomeController();
Router::get("home", [$home, 'getHomePage']); 

$router->route($request);