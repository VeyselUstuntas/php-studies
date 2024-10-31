<?php
class Route
{
    public $path;
    public $callable;
    public $method;

    public function __construct($path, $callable, $method)
    {
        $this->path = $path;
        $this->callable = $callable;
        $this->method = $method;
    }
}
