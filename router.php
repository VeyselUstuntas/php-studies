<?php

class Router
{
    public function route($requestUri)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uriSegments = explode('/', trim($uri, '/'));

        $page = isset($uriSegments[1]) ? $uriSegments[1] : null;
        $parameter = isset($uriSegments[2]) ? $uriSegments[2] : null;

        switch ($page) {
            case 'fibonacci':
                require 'fibonacci.php';
                $fibonacci = new Fibonacci();
                $fibonacci->setFibonacciStep($parameter);
                $result = $fibonacci->stringify();
                $title = "Fibonacci Numbers";
                include "route.php";
                break;

            case 'prime-number':
                require 'prime-number.php';
                $primeNumber = new PrimeNumber();
                $primeNumber->setPrimeNumberLimit($parameter);
                $result = $primeNumber->stringify();
                $title = "Prime Numbers";
                require "route.php";
                break;

            case 'index':
                break;
        }
    }
}
