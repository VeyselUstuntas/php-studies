<?php
class Route
{
    public string $path;
    public $callable;
    public string $method;

    public function __construct(string $path, callable $callable, string $method)
    {
        $this->path = $path;
        $this->callable = $callable;
        $this->method = $method;
    }
}
