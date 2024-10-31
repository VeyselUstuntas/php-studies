<?php
class FibonacciController
{
    private $_context;

    public function __construct($context)
    {
        $this->_context = $context;
    }

    public function fibonacci()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        } else if (($_SERVER["REQUEST_METHOD"] === "GET")) {
            return new Route('fibonacci', function ($value) {
                $this->_context->setFibonacciStep($value);
                $result = $this->_context->stringify();
                $title = "Fibonacci Numbers";
                require "show.php";
            });
        }
    }
}