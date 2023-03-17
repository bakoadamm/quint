<?php


namespace Quint\App\Controllers;


use Illuminate\Database\Capsule\Manager as DB;
use Quint\Quint\Admin;

class QuintController extends Controller {

    private $config = [];

    public function __construct($db, $loader, $twig) {
        parent::__construct($db, $loader, $twig);
    }

    public function list() {
        dd($this->getColumns('users'));
    }

    public function show() {

    }

    public function create() {

    }

    public function edit() {

    }

    public function getColumns($tableName) {
        $db = DB::connection()->getPdo();
        $rs = $db->query("SELECT * FROM {$tableName} LIMIT 0");
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = [
                "type"  => $col['native_type'],
                "name"  => $col['name'],
                "required" => in_array('not_null', $col['flags'])
            ];
        }
        return $columns;
    }
}
