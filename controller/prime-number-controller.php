<?php
class PrimeNumberController
{
    private readonly PrimeNumberCalculator $primeObj;

    public function __construct()
    {
        $this->primeObj = new PrimeNumberCalculator();
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
