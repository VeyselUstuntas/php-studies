<?php
require 'prime-number.php';

class PrimeRepository{
    public static function repositoryContext(){
        return new PrimeNumber();
    }
}