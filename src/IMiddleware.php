<?php


namespace Quint;

interface IMiddleware {
    public function handle(Request $request, callable $next);
}
