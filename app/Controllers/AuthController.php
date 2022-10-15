<?php

namespace Quint\App\Controllers;

use Exception;
use Quint\App\Services\UserService;
use Quint\App\Requests\UserRequest;
use Quint\IDatabase;
use Quint\Request;

class AuthController extends Controller {

    /**
     * @var UserService
     */
    private $service;

    /**
     * AuthController constructor.
     * @param IDatabase $dbh
     */
    public function __construct(IDatabase $dbh, $loader, $twig) {
        parent::__construct($dbh, $loader, $twig);
        $this->service = new UserService($dbh);
    }

    public function renderLoginForm() {
        if(auth()) {
            header('Location: dashboard');
        }

        $errors = $_SESSION['error'] ?? [];
        unset($_SESSION['error']);

        $this->view('login', ['errors' => $errors]);
    }

    /**
     * @param Request $request
     */
    public function login(Request $request) {
        try {
            $this->service
                ->login($request->getRequestBody(UserRequest::class));
            header("Location: /dashboard");
            exit;

        } catch(Exception $e) {
            $_SESSION['error'][] = $e->getMessage();
            header('Location: /login');
            exit;
        }
    }

    /**
     * @param Request $request
     * @throws Exception
     */
    public function register(Request $request) {
        $userRequest = $request->getRequestBody(UserRequest::class);
        $this->service->createUser($userRequest);
    }
}
