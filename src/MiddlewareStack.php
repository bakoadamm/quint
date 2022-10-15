<?php


namespace Quint;


class MiddlewareStack {

    private $middlewares = [];

    /**
     * @param IMiddleware $middleware
     */
    public function add(IMiddleware $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function pipeline(Request $request) {
        return $this->__invoke($request);
    }

    public function __invoke(Request $request) {
        $middleware = array_shift($this->middlewares);
        if($middleware === null) {
            return true;
        }
        return $middleware->handle($request, $this);
    }

}
