<?php
require 'fibonacci.php';

class FibonacciRepository{
    public static function repositoryContext(){
        return new Fibonacci();
    }
}