<?php


namespace Quint\App\Middlewares;

use Quint\App\Services\UserService;
use Quint\Database;
use Quint\IMiddleware;
use Quint\Request;

class AuthMiddleware implements IMiddleware {

    private $protectedRoutesRegexps = [
        '/dashboard/',
        '/me/',
        '/szavazasok/',
        '/felhasznalok/'
    ];

    public function handle(Request $request, callable $next) {

        if(auth()) {
            return $next;
        }

        /**
         * protect only defined routes
         */
        $protectedRoute = false;
        foreach($this->protectedRoutesRegexps as $pattern) {
            if(preg_match($pattern, $request->getPath())) {
                $protectedRoute = true;
            }
        }

        if( ! $protectedRoute) {
            return $next;
        } else {
            header('Location: /login');
        }

    }
}
