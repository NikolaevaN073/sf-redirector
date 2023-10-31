<?php

namespace App\Core;
use App\Core\DataBase;

class User 
{
    protected $db;
    public $id;
    public $role_id;
    public $name;
    public $login;
    public $password;
    public $status;
    public $msg = [];

    public function __construct(DataBase $db, $role_id, $name, $login, $password, $status ='N')
    {
        $this->db = $db;
        $this->role_id = $role_id;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->status = $status;        
    }

    public function check_login () 
    {
        return $this->db->get_data_row('users', 'login', $this->login) ?? false;
    }
    
    public function create ()
    {             
        return $this->db->insert('users', [
            'role_id'  => $this->role_id,
            'name'     => $this->name,
            'login'    => $this->login,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)  
        ]);   
    }   
}
