<?php

namespace Quint\App\Services;

use Quint\App\Models\User;
use Quint\App\Requests\UserRequest;
use Quint\IDatabase;

class UserService {

    /**
     * @var IDatabase
     */
    private $dbh;

    public function __construct(IDatabase $dbh) {
        $this->dbh = $dbh;
    }

    public function login(UserRequest $request) {

        $user = User::where('email', $request->email)->first();

        if( ! $user) {
            throw new \Exception('The email address or password is incorrect', 401);
        }

        if( ! password_verify($request->password, $user->password)) {
            throw new \Exception('The email address or password is incorrect', 401);
        }

        $_SESSION['user'] = $user->toArray();

        return $user;
    }

    public function getUserList() {
        return User::get()->toArray();
    }

    public function createUser(UserRequest $request) {
        $user = new User;
        $user->name = $request->name;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();
    }

    public function generateToken() {

        /*
        dd(PHP_SESSION_ACTIVE);
        dd(session_status());
        dd($this->generateToken());
        dd(session_id());
        */

        return uniqid('se_', true);
    }

    public function isSessionStarted() {
        if(php_sapi_name() === 'cli') {
            return false;
        }
        return session_status() === PHP_SESSION_ACTIVE;
    }


}
