<?php
class FibonacciNumberController
{
    private FibonacciNumberCalculator $fibonacciObj;

    public function __construct(FibonacciNumberCalculator $fibonacciObj)
    {
        $this->fibonacciObj = $fibonacciObj;
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
