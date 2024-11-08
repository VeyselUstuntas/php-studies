<?php
class MiddlewareStack{

    protected $start;
    public function __construct(protected BaseRequest $baseRequest)
    {
        $this->start = function(){
            var_dump("start middleware"); 
            $requestBody = $this->baseRequest->requestBody;
            return $requestBody;
        };
    }

    public function add(IMiddleware $middleware){
        $next = $this->start;

        // ilk başta ilk eklenen midd. gelecek buna gireck. gelen middleware işlenecek burda ve ordan glen sonuc start'a yazılacak.
        $this->start = function() use ($middleware, $next){
            return $middleware($next); //start app, first middleware,second....
        };

    }

    public function handle(){
        return call_user_func($this->start);
    }
}   