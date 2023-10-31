<?php

use App\Core\Model;
use App\Core\DataBase;
use App\Core\User;

class Model_Register extends Model 
{
    private $db; 
    public $msg;  

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }

    public function register_user($data) 
    {        
        $user = new User ($this->db, $data['role'], $data['name'], $data['login'], $data['password']);
        
        if ($user->check_login($user->login)) {
            $this->msg = 'Пользователь с таким логином уже существует!';
        } else {
            $user->create();
            setcookie('isNewUser_id', $user->id, time()+60*60*24);
            $this->msg = 'Пользователь успешно зарегистрирован!';
        }
        return $this->msg;
    }
}
    