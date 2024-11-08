<?php

class App{

    protected MiddlewareStack $middleware;

    public function __construct(MiddlewareStack $middleware)
    {
        $this->middleware = $middleware;
    }

    public function add(IMiddleware $middleware){
        $this->middleware->add($middleware);
    }

    public function run(){
        $this->middleware->handle();
        var_dump("run app");
    }
}