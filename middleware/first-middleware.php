<?php
require __DIR__ . "/core/middleware.php";
class FirstMiddleware implements IMiddleware
{
    public function __invoke(callable $next)
    {
        var_dump("first middleware");

        $requestBody = $next();

        $keys = array_keys($requestBody);
        // var_dump($keys[0]);
        for ($i = 0; $i < count($keys); $i++) {
            $key = $keys[$i];
            $value = $requestBody[$key];

            // var_dump($key);
            // var_dump($value);
            /**
             * @var string $data
             */
            $data = $key . " : " . $value . "\n";
            $currentDateTime = new DateTime();

            file_put_contents("./log.txt", $data ."\n", FILE_APPEND);
        }
        file_put_contents("./log.txt",$currentDateTime->format('d-m-Y H:i:s')."\n\n", FILE_APPEND);

        return $next();
    }
}
