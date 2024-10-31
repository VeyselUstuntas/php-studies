<?php
class PrimeController
{
    private $prime;

    public function __construct(PrimeNumber $prime)
    {
        $this->prime = $prime;
    }

    public function prime()
    {
        return function ($value) {
            $this->prime->setPrimeNumberLimit($value);
            $result = $this->prime->stringify();
            echo "Prime Numbers <br>";
            foreach ($result as $number) {
                echo "$number  ";
            }
        };
    }
}
