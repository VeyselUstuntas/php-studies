<?php
class FibonacciNumberController
{
    private readonly FibonacciNumberCalculator $fibonacciObj;

    public function __construct()
    {
        $this->fibonacciObj = new FibonacciNumberCalculator();
    }

    public function getFibonacciNumbers($limit)
    {
        $this->fibonacciObj->setFibonacciStep($limit);
        $fibonacciNumbers = $this->fibonacciObj->stringify();
        echo "Fibonacci Numbers <br>";
        foreach ($fibonacciNumbers as $fibonacciNumber) {
            echo "$fibonacciNumber  ";
        }
    }
}
