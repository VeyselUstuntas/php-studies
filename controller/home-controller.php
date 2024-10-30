<?php

class HomeController
{
    public static function homeRoute()
    {
        return new Route('home', function () {
            require 'home.php';
        });
    }
}
