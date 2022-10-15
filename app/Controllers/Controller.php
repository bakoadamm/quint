<?php

namespace Quint\App\Controllers;

use Quint\IDatabase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller {

    /**
     * @var FilesystemLoader
     */
    protected $loader;

    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var IDatabase
     */
    protected $database;

    public function __construct(IDatabase $database, FilesystemLoader $loader, Environment $twig) {
        $this->loader   = $loader;
        $this->twig     = $twig;
        $this->database = $database;
    }

    protected function view($template, $data = []) {
        echo ($this->twig->load("@templates/{$template}.twig"))->render($data);
    }
}
