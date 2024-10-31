<?php
require 'abstract-base.php';
class FibonacciNumber extends AbstractBase
{
    private $step;


    public function stringify()
    {
        return $this->fibonacciNumbers();
    }

    public function setFibonacciStep(int $step)
    {
        $this->step = $step;
    }


    private function fibonacciNumbers()
    {
        $list = array(0, 1);
        if ($this->step == 1) {
            return [0];
        } elseif ($this->step == 2) {
            return [0, 1];
        }
        for ($i = 2; $i < $this->step; $i++) {
            $sum = $list[$i - 2] + $list[$i - 1];
            $list[] = $sum;
        }
        return $list;
    }
}
