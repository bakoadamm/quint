<?php


namespace Quint\CLI;


class Cli {
    protected $printer;

    protected $registry = [];

    public function __construct() {
        $this->printer = new Printer();
    }

    public function getPrinter() {
        return $this->printer;
    }

    public function registerCommand($name, $callable) {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command) {
        return $this->registry[$command] ?? null;
    }

    public function runCommand(array $argv = []) {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }

        call_user_func($command, $argv);
    }
}
