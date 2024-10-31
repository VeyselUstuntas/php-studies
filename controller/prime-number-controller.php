<?php
class PrimeNumberController
{
    private PrimeNumberCalculator $primeObj;

    public function __construct(PrimeNumberCalculator $primeObj)
    {
        $this->primeObj = $primeObj;
    }

    public function getPrimeNumbers($limit)
    {
        $this->primeObj->setPrimeNumberLimit($limit);
        $primeNumbers = $this->primeObj->stringify();
        echo "Prime Numbers <br>";
        foreach ($primeNumbers as $primeNumber) {
            echo "$primeNumber  ";
        }
    }
}
