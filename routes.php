<?php

use Quint\App\Controllers\{
    DashboardController,
    AuthController,
    QuintController,
    UserController,
    VoteController
};

$router->get('/', [DashboardController::class, 'start']);
$router->get('/login', [AuthController::class, 'renderLoginForm']);
$router->get('/dashboard', [DashboardController::class, 'dashboard']);

$router->get('/quint-data', [QuintController::class, 'list']);

$router->post('/login', [AuthController::class, 'login']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/felhasznalok', [UserController::class, 'users']);

$router->get('/getdata', [UserController::class, 'getData']);

$router->get('/szavazasok', [VoteController::class, 'votes']);
$router->get('/szavazas/uj', [VoteController::class, 'create']);

$router->get('/logout', function() {
    session_destroy();
    unset($_SESSION['user']);
    header('Location: /login');
});

