<?php

class HomeController
{
    public function home()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        else if($_SERVER['REQUEST_METHOD'] === 'GET'){
            return new Route('home', function () {
                require 'home.php';
            });
        }

    }
}
