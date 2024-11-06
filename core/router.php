<?php

class Router
{
    /** 
     * @param Route[] $routes
     */
    private static $routes = [];
    
    private DI $container;

    public function __construct(DI $container)
    {
        $this->container = $container;
    }

    public static function get(string $path, $callable)
    {
        self::register($path,$callable,'GET');
    }

    public static function post(string $path, $callable)
    {
        self::register($path,$callable,'POST');
    }

    public static function register(string $path, $callable, string $method)
    {
        $newRoute = new Route($path,$callable, $method);
        self::$routes[] = $newRoute;
    }


    public function route(BaseRequest $request)
    {
        $uri = $request->path;
        $uriSegments = explode('/', trim($uri, '/'));

        $page = isset($uriSegments[1]) ? $uriSegments[1] : null;
        $parameter = isset($uriSegments[2]) ? $uriSegments[2] : null;

        if (count($uriSegments) == 1) {
            header("Location: /php-calismasi/orders/");
            exit;
        }


        if ($parameter == null && ($page == "fibonacci" || $page == "prime-number")) {
            echo "Parametre Girilmelidir.";
            return;
        }

        /**
         * @var Route $route
        */
        foreach (self::$routes as $route) {
            if ($route->path == $page && $route->method == $request->method) {
                $controller = $this->container->get($route->callable[0]);
                $function = $route->callable[1];
                call_user_func([$controller, $function], $parameter);
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}
