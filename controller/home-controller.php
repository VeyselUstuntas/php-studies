<?php

class HomeController
{
    public function home()
    {
        return function () {
            require 'home.php';
        };
    }
}
