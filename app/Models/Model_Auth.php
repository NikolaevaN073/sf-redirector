<?php

use App\Core\Model;
use App\Core\DataBase;
use App\Core\Auth;

class Model_Auth extends Model 
{
    private $db, $auth;
    public $data = [];  

    public function __construct(DataBase $db, Auth $auth)
    {
        $this->db = $db;
        $this->auth = $auth;
    }
   
    public function get_data ()
    {
        $_SESSION['token'] = $_SESSION['token'] ?? hash('gost-crypto', random_int(0, 999999));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    
            $this->auth->token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING); 
            $this->auth->login = $_POST['login']; 
            $this->auth->password = $_POST['password'];

            if (!$this->auth->check_token()) {
                $this->data[] = 'Ошибка авторизации';
            } else {
                
                if ($this->auth->check_login()) {
                    $this->data[] = 'Пользователя с таким логином не существует';
                } else {   
                    if (!$this->auth->check_password()) {
                        $this->data[] = 'Неверный пароль';
                    } else {                         
                        $_SESSION['isLoggedIn'] = true;
                        $user = $this->db->get_data_row('users', 'login', $this->auth->login);
                        setcookie('user_id', $user['id'], time()+60*60*24); 
                        $role = $this->db->get_data_row('roles', 'id', $user['role_id']);              
                        $this->auth->redirect($role['role_name']);                
                    }
                }        
            }
            return $this->data;
        }
    }
}        
