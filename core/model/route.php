<?php
class Route
{
    public string $path;
    public array $callable;
    public string $method;

    public function __construct(string $path, array $callable, string $method)
    {
        $this->path = $path;
        $this->callable = $callable;
        $this->method = $method;
    }
}
