<?php
namespace Middleware;

use Core\Model\BaseRequest;
use DateTime;

class FirstMiddleware
{

    public function __invoke(BaseRequest $next)
    {
        var_dump("first middleware");

        $requestBody = $next->requestBody;

        $keys = array_keys($requestBody);
        for ($i = 0; $i < count($keys); $i++) {
            $key = $keys[$i];
            $value = $requestBody[$key];

            /**
             * @var string $data
             */
            $data = $key . " : " . $value . "\n";

            file_put_contents("./log.txt", $data . "\n", FILE_APPEND);
        }
        $currentDateTime = new DateTime();

        file_put_contents("./log.txt", $currentDateTime->format('d-m-Y H:i:s') . "\n\n", FILE_APPEND);
    }
}
