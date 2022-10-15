<?php

namespace Quint\App\Controllers;

use Quint\App\Services\UserService;
use Quint\IDatabase;

class UserController extends Controller {

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

    public function users() {
        $users = $this->service->getUserList();
        $this->view('users/list', ['users' => $users]);
    }
}
