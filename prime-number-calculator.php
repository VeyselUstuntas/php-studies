<?php
class PrimeNumberCalculator extends AbstractCalculator
{
    private $limit;

    public function stringify()
    {
        return $this->primeNumbers();
    }

    public function setPrimeNumberLimit(int $limit)
    {
        $this->limit = $limit;
    }

    private function primeNumbers()
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
