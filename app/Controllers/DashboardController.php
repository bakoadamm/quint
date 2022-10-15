<?php

namespace Quint\App\Controllers;

class DashboardController extends Controller {

    public function __construct($db, $loader, $twig) {
        parent::__construct($db, $loader, $twig);
    }

    public function dashboard() {
        $this->view('dashboard');
    }

    public function start() {
        isset($_SESSION['user']) ? redirect('/dashboard'): redirect('/login');
    }
}
