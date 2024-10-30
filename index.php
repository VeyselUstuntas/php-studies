<?php
require 'router.php';
require 'route.php';
require 'controller/fibonacci-controller.php';
require 'controller/prime-controller.php';
require 'controller/home-controller.php';

$router = new Router();

$router->register(FibonacciController::fibonacci());

$router->register(PrimeController::prime());

$router->register(HomeController::homeRoute());

$router->route($_SERVER['REQUEST_URI']);
