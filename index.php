<?php

declare(strict_types=0);

use Quint\Quint;
use Quint\ServiceContainer;

define('PROJECT_ROOT', __DIR__ . DIRECTORY_SEPARATOR);

require_once(PROJECT_ROOT . 'helpers.php');
require_once(PROJECT_ROOT . 'vendor/autoload.php');

error_reporting( E_ALL & ~E_STRICT & ~E_DEPRECATED );
ini_set( 'display_errors', 1);

//header('Content-Type: application/json');

(new Quint(new ServiceContainer(require_once PROJECT_ROOT. 'services.php')))->run();
