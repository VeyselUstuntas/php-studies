<?php
class ThirdMiddleware implements IMiddleware
{
    public function __invoke(callable $next)
    {
        var_dump("third middleware");
        $jsonResult = $next();
        var_dump($jsonResult);
    }
}
