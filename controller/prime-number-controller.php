<?php
class PrimeNumberController
{

    public function __construct(protected PrimeNumberCalculator $primeNumberService) {}

    public function getPrimeNumbers($limit)
    {
        $this->primeNumberService->setPrimeNumberLimit($limit);
        $primeNumbers = $this->primeNumberService->stringify();
        echo "Prime Numbers <br>";
        foreach ($primeNumbers as $primeNumber) {
            echo "$primeNumber  ";
        }
    }
}
