<?php
class FibonacciController
{
    private $fibonacci;

    public function __construct(Fibonacci $fibonacci)
    {
        $this->fibonacci = $fibonacci;
    }
    public function fibonacci()
    {
        return function ($value) {
            $this->fibonacci->setFibonacciStep($value);
            $result = $this->fibonacci->stringify();
            echo "Fibonacci Numbers <br>";
            foreach ($result as $number) {
                echo "$number  ";
            }
        };
    }
}
