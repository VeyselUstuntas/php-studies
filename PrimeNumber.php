<?php

class PrimeNumber
{
    public $limit;

    function __construct($limit)
    {
        $this->limit = $limit;
    }

    public function primeNumbers()
    {
        $list = array();
        if ($this->limit > 1) {
            $list[] = 2;
        }
        for ($i = 2; $i <= $this->limit; $i++) {
            if ($i % 2 != 0) {
                $isPrime = true;

                for ($j = 2; $j <= sqrt($i); $j++) {
                    if ($i % $j == 0) {
                        $isPrime = false;
                        break;
                    }
                }

                if ($isPrime) {
                    $list[] = $i;
                }
            }
        }
        return $list;
    }
}
