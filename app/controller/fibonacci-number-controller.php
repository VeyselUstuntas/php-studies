<?php
namespace Controller;

use Services\FibonacciNumberCalculator;

class FibonacciNumberController
{

    public function __construct(protected FibonacciNumberCalculator $fibonacciNumberService) {}

    public function getFibonacciNumbers($limit)
    {
        $this->fibonacciNumberService->setFibonacciStep($limit);
        $fibonacciNumbers = $this->fibonacciNumberService->stringify();
        echo "Fibonacci Numbers <br>";
        foreach ($fibonacciNumbers as $fibonacciNumber) {
            echo "$fibonacciNumber  ";
        }
    }
}
