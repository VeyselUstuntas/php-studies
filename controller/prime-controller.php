<?php
class PrimeController
{
    private $_context;

    public function __construct($context)
    {
        $this->_context = $context;
    }

    public function prime()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        } else if (($_SERVER["REQUEST_METHOD"] === "GET")) {
            return new Route('prime-number', function ($value) {
                $this->_context->setPrimeNumberLimit($value);
                $result = $this->_context->stringify();
                $title = "Prime Numbers";
                require "show.php";
            });
        }
    }
}