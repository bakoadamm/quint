<?php

namespace Quint\App\Controllers;

use Quint\App\Models\User;
use Quint\App\Services\UserService;
use Quint\IDatabase;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Capsule\Manager as DB;

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

    public function getData() {
        $db = DB::connection()->getPdo();
        $rs = $db->query('SELECT * FROM users LIMIT 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = [
                "type"  => $col['native_type'],
                "name"  => $col['name'],
                "required" => in_array('not_null', $col['flags'])
            ];
        }
        dd($columns);


        //$user = new User;
        //dd($user->getTableColumns());
        //dd($user->attributes);


        //dd(Schema::getFacadeRoot());
        //Schema::setAsGlobal();




        $schemaBuilder = DB::getSchemaBuilder();
        $schema = $schemaBuilder->getColumnListing('users');
        //$types = $schemaBuilder->table('users');

        $schemaBuilder->table('users', function($item) {
            dump($item);
        });



        //dd($types);


        //$schema2 = Schema::getColumnListing('users');
        dd($schema);
    }
}
