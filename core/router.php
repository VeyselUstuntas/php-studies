<?php

class Router
{
    /** 
     * @param Route[] $routes
     */
    private static $routes = [];
    protected static DIManager $dIManager;

    public function __construct($dIManager)
    {
        self::$dIManager = $dIManager;
    }

    public static function get(string $path, $callable)
    {
        self::register($path, $callable, 'GET');
    }

    public static function post(string $path, $callable)
    {
        self::register($path, $callable, 'POST');
    }

    // $callable -> ['sınıf', 'metod']
    public static function register(string $path, $callable, string $method)
    {
        //bağımlılıkları burda çözümleyecği
        $controller = self::$dIManager->resolve($callable[0]);
        $action = $callable[1];
        $newRoute = new Route($path, [$controller,$action], $method);
        self::$routes[] = $newRoute;
    }


    public function route(BaseRequest $request)
    {
        $uri = $request->path;
        $uriSegments = explode('/', trim($uri, '/'));

        $page = isset($uriSegments[1]) ? $uriSegments[1] : null;
        $parameter = isset($uriSegments[2]) ? $uriSegments[2] : null;

        if ($parameter == null && ($page == "fibonacci" || $page == "prime-number")) {
            echo "Parametre Girilmelidir.";
            return;
        }

        /**
         * @var Route $route
         */
        foreach (self::$routes as $route) {
            if ($route->path == $page && $route->method == $request->method) {
                call_user_func($route->callable, $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}
