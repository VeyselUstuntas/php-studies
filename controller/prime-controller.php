<?php
class PrimeController
{
    public static function prime()
    {
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
