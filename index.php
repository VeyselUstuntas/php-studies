<?php
require 'router.php';
require 'route.php';
require 'controller/fibonacci-controller.php';
require 'controller/prime-controller.php';
require 'controller/home-controller.php';
require 'repository/fibonacci-repository.php';
require 'repository/prime-repository.php';

$router = new Router();

$fibonacci = new FibonacciController(FibonacciRepository::repositoryContext());
Router::register($fibonacci->fibonacci());

$prime = new PrimeController(PrimeRepository::repositoryContext());
Router::register($prime->prime());

$home = new HomeController();
Router::register($home->home());

$router->route($_SERVER['REQUEST_URI']);