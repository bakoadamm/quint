<?php


namespace Quint\App\Requests;


class UserRequest
{
    /** @var string */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;


    /**
     * @var integer
     */
    public $role_id;

    /*
    public function __construct() {
        $this->password = 'password';
    }
    */

    public function validate() {

        /*
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        */


        return [
            'name' => [
                "length" => 100
            ]
        ];
    }

}
