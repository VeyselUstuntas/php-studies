<?php
namespace Core\Model;

class Route
{
    public string $path;
    public array $callable;
    public string $method;
    public ?array $beforeMiddlewares = [];
    public ?array $afterMiddlewares = [];

    public function __construct(string $path, array $callable, string $method)
    {
        $this->path = $path;
        $this->callable = $callable;
        $this->method = $method;
    }

    public function getBeforeMiddlewares(): array
    {
        return $this->beforeMiddlewares;
    }

    public function getAfterMiddlewares(): array
    {
        return $this->afterMiddlewares;
    }
}
