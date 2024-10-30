<?php
require 'router.php';
$router = new Router();
$router->route($_SERVER['REQUEST_URI']);
