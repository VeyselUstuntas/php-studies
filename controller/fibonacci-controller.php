<?php

class FibonacciController
{

    public static function fibonacci()
    {
        if($_SERVER["REQUEST_METHOD"]==="POST"){

        }
        else if(($_SERVER["REQUEST_METHOD"]==="GET")){
            return new Route('fibonacci',function($value){
                require 'fibonacci.php';
                $fibonacci = new Fibonacci();
                $fibonacci->setFibonacciStep($value);
                $result = $fibonacci->stringify();
                $title = "Fibonacci Numbers";
                require "show.php"; 
            });
        }

    }
}
