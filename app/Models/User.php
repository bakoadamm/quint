<?php


namespace Quint\App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model {
    //protected $table = 'igfeb_ma';
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = ['password'];
}
