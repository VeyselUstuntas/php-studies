<?php
class DI
{
    private static array $instances = [];
    private BaseRequest $request;

    public function __construct()
    {
        $this->request = RequestParser::parse($_SERVER);

        $this->bind(
            FibonacciNumberController::class,
            function () {
                return new FibonacciNumberController();
            }
        );

        $this->bind(
            PrimeNumberController::class,
            function () {
                return new PrimeNumberController();
            }
        );

        $this->bind(
            OrderController::class,
            function () {
                return new OrderController($this->request);
            }
        );


        $this->bind(
            UserController::class,
            function () {
                return new UserController();
            }
        );

        $this->bind(
            ProductController::class,
            function () {
                return new ProductController();
            }
        );
    }

    public function bind(string $name, callable $resolver)
    {
        self::$instances[$name] = $resolver;
    }

    public function get($name)
    {
        return self::$instances[$name]();
    }
}
