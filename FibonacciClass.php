<?php
class Fibonacci
{
    public $step;

    function __construct($step)
    {
        $this->step = $step;
    }

    public function fibonacciNumbers()
    {
        $list = array(0, 1);
        for ($i = 2; $i < $this->step; $i++) {
            $sum = $list[$i - 2] + $list[$i - 1];
            $list[] = $sum;
        }
        return $list;
    }
}