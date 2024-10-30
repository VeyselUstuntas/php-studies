<?php
class PrimeController
{
    public static function prime()
    {
        if($_SERVER["REQUEST_METHOD"]==="POST"){

        }
        else if(($_SERVER["REQUEST_METHOD"]==="GET")){
            return new Route('prime-number', function ($value) {
                require 'prime-number.php';
                $primeNumber = new PrimeNumber();
                $primeNumber->setPrimeNumberLimit($value);
                $result = $primeNumber->stringify();
                $title = "Prime Numbers";
                require "show.php";
            });
        }

    }
}
