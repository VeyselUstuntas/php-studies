<?php
namespace App\Core;

use App\Core\Model\BaseRequest;
use App\Core\Model\Route;

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

    public static function get(string $path, array $callable, ?array $middlewares = null)
    {
        self::register($path, $callable, 'GET', $middlewares);
    }

    public static function post(string $path, array $callable, ?array $middlewares = null)
    {
        self::register($path, $callable, 'POST', $middlewares);
    }

    // $callable -> ['sınıf', 'metod']
    public static function register(string $path, array $callable, string $method, ?array $middlewares = null)
    {
        //bağımlılıkları burda çözümleyecği
        $controller = self::$dIManager->resolve($callable[0]);
        $action = $callable[1];
        $newRoute = new Route($path, [$controller, $action], $method);

        if (isset($middlewares["before"])) {
            foreach ($middlewares["before"] as $beforeMiddleware) {
                $newRoute->beforeMiddlewares[] = new $beforeMiddleware();
            }
        }

        if (isset($middlewares["after"])) {
            foreach ($middlewares["after"] as $afterMiddleware) {
                $newRoute->afterMiddlewares[] = new $afterMiddleware();
            }
        }
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
                foreach ($route->getBeforeMiddlewares() as $middleware) {
                    $middleware($request);
                }

                $list = call_user_func($route->callable, $parameter);

                foreach ($route->getAfterMiddlewares() as $middleware) {
                    $middleware($list);
                }
                return;
            }
        }
        echo "Sayfa Bulunamadı.";
    }
}
