<?php

use Quint\{
    Database,
    Dispatcher,
    Eloquent,
    MiddlewareStack,
    Request,
    Router,
    ServiceContainer
};
use Dotenv\Dotenv;
use Quint\App\Middlewares\AuthMiddleware;
use Twig\Loader\FilesystemLoader;

return [

    'dotEnv' => function() {
        (Dotenv::createUnsafeImmutable(PROJECT_ROOT))->load();
    },

    'sessionStart' => function() {
        session_start();
        if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
            session_destroy();
            session_start();
        }
    },

    'database' => function() {
        return new Database();
    },

    'eloquent' => function() {
        return new Eloquent();
    },

    'quint' => function() {

    },

    'twigLoader' => function() {
        $loader = new FilesystemLoader(env('APP_TEMPLATE_DIR'));
        $loader->addPath(env('APP_TEMPLATE_DIR'),'templates');
        return $loader;
    },

    'twig' => function(ServiceContainer $container) {
        $twig = new \Twig\Environment($container->get('twigLoader'), [
            'debug' => true,
            'autoescape' => false
        ]);
        $twig->addGlobal('session', $_SESSION);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        return $twig;
    },

    'dispatcher' => function(ServiceContainer $container) {
        $dispatcher = new Dispatcher(
            $container->get('router'),
            $container->get('eloquent'),
            $container->get('twigLoader'),
            $container->get('twig')
        );
        $dispatcher->handle($container->get('request'));
        return $dispatcher;
    },

    'router' => function() {
        $router = new Router();
        require_once PROJECT_ROOT . 'routes.php';
        return $router;
    },
    
    'middleware' => function(ServiceContainer $container) {
        $middlewareStack = new MiddlewareStack();
        $middlewareStack->add(new AuthMiddleware());
        $middlewareStack->pipeline($container->get('request'));
    },

    'request' => function(ServiceContainer $container) {
        return new Request(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $container->get('router')->getProtectedRoutes()
        );
    }
];
