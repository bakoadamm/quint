<?php

namespace Quint;

class Quint {

    /**
           ___       _       _
         / _ \ _   _(_)_ __ | |_
        | | | | | | | | '_ \| __|
        | |_| | |_| | | | | | |_
        \__\_\\__,_|_|_| |_|\__|
     *
     *
     * @author  : 'Adam Bako'
     * @link    : 'https://bakoadam.com'
     * @license : MIT
     */

    /**
     * @var ServiceContainer
     */
    private $container;

    /**
     * QuizApi constructor.
     * @param ServiceContainer $container
     */
    public function __construct(ServiceContainer $container) {
        $this->container = $container;
    }

    /**
     * Boot
     * @throws \Exception
     */
    public function run() {
        /*
        $this->container->gets([
            'sessionStart',
            'dotEnv',
            'router',
            'middleware',
            'dispatcher'
        ]);
        */

        $this->container->get('sessionStart');
        $this->container->get('dotEnv');
        $this->container->get('router');
        $this->container->get('middleware');
        $this->container->get('dispatcher');

    }

    private function debug() {

        if(env('APP_DEBUG')) {
            error_reporting( E_ALL & ~E_STRICT & ~E_DEPRECATED );
            ini_set( 'display_errors', 1);
        } else {
            error_reporting(0);
            ini_set( 'display_errors', 0);
        }
    }
}
